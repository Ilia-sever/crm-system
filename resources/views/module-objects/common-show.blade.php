@extends ('layouts.master') @section ('content')
@include('layouts.delete-confirmation')
<meta id="module-code" value="{{$module_code}}">
<h1>{{trans_choice('strings.modules.' . $module_code,1)}}</h1>
<div class="object-show">
    @yield('object-show')
    @if (auth()->user()->can('update',"$module_code",$data['object']))
    <a type="submit" href="/{{$module_code}}/edit/{{$data['object']['id']}}" class="btn btn-default module-button">{{trans('strings.operations.edit')}}</a>
    @endif
    @if (auth()->user()->can('delete',"$module_code",$data['object']))
    <a type="submit" href="" name="{{$data['object']['id']}}" class="btn btn-default module-button module-button_delete">{{trans('strings.operations.delete')}}</a>
    @endif
</div>

@endsection