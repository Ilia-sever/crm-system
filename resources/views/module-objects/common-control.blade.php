@extends ('layouts.master') @section ('content')

@if ($data['object']['id']) 
    <h1>{{trans('strings.operations.editing-object')}}{{trans_choice('strings.modules.' . $module_code,1)}}</h1>
    <form class="object-form" method="POST" action="/{{$module_code}}/update">
    <input type="hidden" name="id" value="{{$data['object']['id']}}">
@else
    <h1>
    {{trans('strings.operations.creating-object')}}
    {{trans_choice('strings.modules.' . $module_code,1)}}
    </h1>
    <form class="object-form" method="POST" action="/{{$module_code}}/create">
    <input type="hidden" name="id" value="">
    
@endif
	
{{csrf_field()}}

<div class="errors">
@include('layouts.errors')
</div>

@yield('object-control')

<button type="submit" class="btn btn-default module-button">{{trans('strings.operations.save')}}</button>

</form>
@endsection