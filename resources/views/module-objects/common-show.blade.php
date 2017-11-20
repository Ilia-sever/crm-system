@extends ('layouts.master') @section ('content')
<h1>{{trans_choice('strings.modules.' . $data['module-code'],1)}}</h1>
<div class="object-show">
    @yield('object-show')
    <a type="submit" href="/{{$data['module-code']}}/edit/{{$data['object']['id']}}" class="btn btn-default module-button">{{trans('strings.operations.edit')}}</a>
</div>

@endsection