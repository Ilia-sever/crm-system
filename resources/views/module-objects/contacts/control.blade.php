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

    <div class="form-group multifield">
        <label>{{trans('strings.fields-name.companies')}}</label>
        <div class="multifield__item multifield__example">
            <select class="form-control select-plus-ready" name="companies[]">
                <option value="">{{trans('strings.messages.select')}}</option>
                @foreach($data['clients'] as $client)
                <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
            </select>
            <button class="multifield__delete action-button delete-button"></button>   
        </div>
        @if ($data['object']->companies)
        @foreach($data['object']->companies as $company)
        <div class="multifield__item">
            <select class="form-control select-plus" name="companies[]">
                <option value="">{{trans('strings.messages.select')}}</option>
                @foreach($data['clients'] as $client)
                <option value="{{$client->id}}" @if ($company->id==$client->id) selected @endif>{{$client->name}}</option>
                @endforeach
            </select>
            <button class="multifield__delete action-button delete-button" value="$company->id"></button>
        </div>
        @endforeach
        @endif
        
        <button class="multifield__add action-button add-button"></button>
    </div>



    
@endsection