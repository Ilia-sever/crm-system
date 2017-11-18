@extends ('module-objects.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']['id']}}">
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.fullname')}}</label>
        <p class="text-info" name="surname">{{$data['object']['fullname']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.sex')}}</label>
        <p class="text-info" name="sex">{{$data['object']['sex']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.dob')}}</label>
        <p class="text-info" name="dob">{{$data['object']['dob']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.role')}}</label>
        <p class="text-info" name="role">{{$data['object']['role']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.post')}}</label>
        <p class="text-info" name="post">{{$data['object']['post']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.email')}}</label>
        <p class="text-info" name="email">{{$data['object']['email']}}</p>
    </div>

    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.tel')}}</label>
        <p class="text-info" name="tel">{{$data['object']['tel']}}</p>
    </div>

    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.skype')}}</label>
        <p class="text-info" name="skype">{{$data['object']['skype']}}</p>
    </div>

@endsection