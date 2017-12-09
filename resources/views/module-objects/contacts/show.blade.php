@extends ('module-objects.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']->id}}">
    <div class="object-field">
        <label>{{trans('strings.fields-name.fullname')}}</label>
        <p class="text-info" name="surname">{{$data['object']->fullname}}</p>
    </div>
    
    <div class="object-field">
        <label>{{trans('strings.fields-name.email')}}</label>
        <p class="text-info" name="email">{{$data['object']->email}}</p>
    </div>

    <div class="object-field">
        <label>{{trans('strings.fields-name.tel')}}</label>
        <p class="text-info" name="tel">{{$data['object']->tel}}</p>
    </div>

    <div class="object-field">
        <label>{{trans('strings.fields-name.skype')}}</label>
        <p class="text-info" name="skype">{{$data['object']->skype}}</p>
    </div>

    @foreach($data['object']->socnetworks as $socnetwork)
    <div class="object-field">
        @if ($socnetwork->resource)
        <label>{{$socnetwork->resource}}</label>
        @else
        <label>{{trans('strings.fields-name.other-resource')}}</label>
        @endif
        <p class="text-info" name="skype"><a href="{{$socnetwork->link}}">{{$socnetwork->link}}</a></p>
    </div>
    @endforeach

    <div class="object-field">
        <label>{{trans('strings.fields-name.companies')}}</label>
        <ul class="text-info text-info_full">
        @foreach($data['object']->companies as $company)
        <li>
            <a href="/clients/show/{{$company->id}}">{{$company->name}}</a>
        </li>
        @endforeach
        </ul>
    </div>

@endsection