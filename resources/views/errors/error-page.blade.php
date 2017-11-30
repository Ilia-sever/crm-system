@extends ('layouts.master') @section ('content')
<div class="alert alert-danger">
    <p>{{trans('strings.messages.'.$data['message'])}}</p>
</div>
@endsection