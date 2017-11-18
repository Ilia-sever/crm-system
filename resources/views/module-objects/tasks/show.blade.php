@extends ('module-objects.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']['id']}}">
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.name')}}</label>
        <p class="text-info" name="surname">{{$data['object']['name']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.status')}}</label>
        <p class="text-info" name="sex">{{$data['object']['status']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.deadline')}}</label>
        <p class="text-info" name="dob">{{$data['object']['deadline']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.plaintime')}}</label>
        <p class="text-info" name="role">{{$data['object']['plaintime']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.assignment')}}</label>
        <p class="text-info" name="post">{{$data['object']['assignment']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.director')}}</label>
        <p class="text-info" name="email">{{$data['object']['director']}}</p>
    </div>

    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.executor')}}</label>
        <p class="text-info" name="tel">{{$data['object']['executor']}}</p>
    </div>

    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.description')}}</label>
        <p class="text-info" name="skype">{{$data['object']['description']}}</p>
    </div>
@endsection