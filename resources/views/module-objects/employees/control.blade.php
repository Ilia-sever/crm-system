@extends ('module-objects.common-control') @section ('object-control')

    <div class="form-group ">
        <label>{{trans('strings.fields-name.surname')}}</label>
        <input type="text" class="form-control" name="surname" value="{{$data['object']->surname}}">
    </div>

    <div class="form-group">
        <label>{{trans('strings.fields-name.firstname')}}</label>
        <input type="text" class="form-control" name="firstname" value="{{$data['object']->firstname}}">
    </div>

    <div class="form-group">
        <label>{{trans('strings.fields-name.lastname')}}</label>
        <input type="text" class="form-control" name="lastname" value="{{$data['object']->lastname}}">
    </div>
    <div class="form-group">
        <label>{{trans('strings.fields-name.sex')}}</label>
        <select class="form-control" name="sex">
        	<option value="" @if ($data['object']->sex) selected @endif></option>
        	<option value="male" @if ($data['object']->sex=='male') selected @endif>{{trans('strings.fields-name.sexes.male')}}</option>
        	<option value="female" @if ($data['object']->sex=='female') selected @endif>{{trans('strings.fields-name.sexes.female')}}</option>
        </select>
    </div>
    <div class="form-group">
        <label>{{trans('strings.fields-name.dob')}}</label>
        <input type="text" class="modal-calendar form-control" name="dob" value="{{$data['object']->dob}}" readonly>
    </div>
    @if (auth()->user()->can('set_role_id','employees'))
    <div class="form-group">
        <label>{{trans('strings.fields-name.role')}}</label>
        <select class="form-control" name="role_id">
        @foreach($data['roles'] as $role)
        <option value="{{$role['id']}}" @if ($data['object']->role_id==$role['id']) selected @endif>{{trans('strings.roles.'.$role['name'])}}</option>
        @endforeach
        </select>
    </div>
    @endif
    @if (auth()->user()->can('set_post','employees'))
    <div class="form-group">
        <label>{{trans('strings.fields-name.post')}}</label>
        <input type="text" class="form-control" name="post" value="{{$data['object']->post}}">
    </div>
    @endif
    <div class="form-group">
        <label>{{trans('strings.fields-name.email')}}</label>
        <input type="text" class="form-control" name="email" value="{{$data['object']->email}}">
    </div>
    <div class="checkbox-tab">
        <div class="checkbox">
            <label>
                <input type="checkbox" class="checkbox-tab__checkbox"> {{trans('strings.operations.set-new-password')}}
            </label>
        </div>
        <div class="checkbox-tab__tab">
        <div class="form-group">
            <button class="password-generate__btn">{{trans('strings.operations.generate')}}</button>
            <span class="password-generate__value"></span>
        </div>
        <div class="form-group">
            <label>{{trans('strings.fields-name.new_password')}}</label>
            <input type="password" class="form-control" name="new_password">
        </div>
        <div class="form-group">
            <label>{{trans('strings.fields-name.password_confirmation')}}</label>
            <input type="password" class="form-control" name="new_password_confirmation">
        </div>
        </div>
    </div>
    <div class="form-group">
        <label>{{trans('strings.fields-name.tel')}}</label>
        <input type="text" class="phone-masked form-control" name="tel" value="{{$data['object']->tel}}">
    </div>

    <div class="form-group">
        <label>{{trans('strings.fields-name.skype')}}</label>
        <input type="text" class="form-control" name="skype" value="{{$data['object']->skype}}">
    </div>

    <div class="form-group multifield">
        <label>{{trans('strings.fields-name.socnetworks')}}</label>
        @if ($data['object']->socnetworks)
        @foreach($data['object']->socnetworks as $socnetwork)
        <div class="multifield__item">
            <div class="inputs-line">
                <input type="hidden" name="socnetwork_ids[]" value="{{$socnetwork->id}}">
                <input type="text" class="form-control" name="socnetwork_resources[]" value="{{$socnetwork->resource}}">
                <input type="text" class="form-control" name="socnetwork_links[]" value="{{$socnetwork->link}}">
            </div>
            <button class="multifield__delete action-button delete-button"></button>
        </div>
        @endforeach
        @endif
        <div class="multifield__item multifield__example">
            <div class="inputs-line">
                <input type="hidden" name="socnetwork_ids[]">
                <input type="text" class="form-control" name="socnetwork_resources[]" value="" placeholder="{{trans('strings.fields-name.resource')}}">
                <input type="text" class="form-control" name="socnetwork_links[]" value="" placeholder="{{trans('strings.fields-name.link')}}">
            </div>
            <button class="multifield__delete action-button delete-button"></button>
        </div>
        <button class="multifield__add action-button add-button"></button>
    </div>
    
@endsection