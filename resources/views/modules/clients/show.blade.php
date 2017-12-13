@extends ('modules.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']->id}}">
    <div class="object-field">
        <label>{{trans('strings.fields-name.name')}}</label>
        <p class="text-info">{{$data['object']->name}}</p>
    </div>

    <div class="object-field">
        <label>{{trans('strings.fields-name.site')}}</label>
        <p class="text-info"><a href="{{$data['object']->site}}">{{$data['object']->site}}</a></p>
    </div>

    @if ($data['object']->manager) 
    <div class="object-field">
        <label>{{trans('strings.fields-name.manager')}}</label>
        <p class="text-info"><a href="/employees/show/{{$data['object']->manager->id}}">{{$data['object']->manager}}</a></p>
    </div>
    @endif

    @if ($data['object']->contacts) 
    <div class="object-field">
        <label>{{trans('strings.fields-name.client-contacts')}}</label>
        <ul class="text-info text-info_full">
        @foreach($data['object']->contacts as $contact)
        <li>
            <a href="/contacts/show/{{$contact->id}}">{{$contact}}</a>
            @if ($contact->tel) ({{$contact->tel}}) @endif
            
        </li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class="object-field">
        <label>{{trans('strings.fields-name.client-projects')}}</label>
        <ul class="text-info text-info_full">
        @foreach($data['object']->projects as $project)
        <li>
            <a href="/projects/show/{{$project->id}}">{{$project->name}}</a>
        </li>
        @endforeach
        </ul>
    </div>

    @include('modules.transactions.transactions-list')

@endsection