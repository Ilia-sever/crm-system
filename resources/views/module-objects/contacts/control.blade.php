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
        <label>{{trans('strings.fields-name.email')}}</label>
        <input type="text" class="form-control" name="email" value="{{$data['object']->email}}">
    </div>
   
    <div class="form-group">
        <label>{{trans('strings.fields-name.tel')}}</label>
        <input type="text" class="phone-masked form-control" name="tel" value="{{$data['object']->tel}}">
    </div>

    <div class="form-group">
        <label>{{trans('strings.fields-name.skype')}}</label>
        <input type="text" class="form-control" name="skype" value="{{$data['object']->skype}}">
    </div>

    <div class="form-group multiselect">
        <label>{{trans('strings.fields-name.companies')}}</label>
        @if ($data['object']->companies)
        @foreach($data['object']->companies as $company)
        <div class="multiselect__item">
            <select class="form-control" name="companies[]">
                <option value="">{{trans('strings.messages.select')}}</option>
                @foreach($data['clients'] as $client)
                <option value="{{$client->id}}" @if ($company->id==$client->id) selected @endif>{{$client->name}}</option>
                @endforeach
            </select>
            <button class="multiselect__delete action-button delete-button" value="$company->id"></button>
        </div>
        @endforeach
        @endif
        <div class="multiselect__item multiselect__example">
            <select class="form-control" name="companies[]">
                <option value="">{{trans('strings.messages.select')}}</option>
                @foreach($data['clients'] as $client)
                <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
            </select>
            <button class="multiselect__delete action-button delete-button" value="$company->id"></button>   
        </div>
        <button class="multiselect__add action-button add-button"></button>
    </div>
    
@endsection