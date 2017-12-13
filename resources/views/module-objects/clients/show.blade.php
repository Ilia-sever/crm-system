@extends ('module-objects.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']->id}}">
    <div class="object-field">
        <label>{{trans('strings.fields-name.name')}}</label>
        <p class="text-info" name="surname">{{$data['object']->name}}</p>
    </div>

    <div class="object-field">
        <label>{{trans('strings.fields-name.site')}}</label>
        <p class="text-info" name="surname"><a href="{{$data['object']->site}}">{{$data['object']->site}}</a></p>
    </div>

    @if ($data['object']->manager) 
    <div class="object-field">
        <label>{{trans('strings.fields-name.manager')}}</label>
        <p class="text-info" name="tel"><a href="/employees/show/{{$data['object']->manager->id}}">{{$data['object']->manager}}</a></p>
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

    @if ($data['object']->transactions) 
    <div class="object-field">
        <label>{{trans('strings.fields-name.transactions')}}</label>
        <ul class="text-info text-info_full">
            @foreach ($data['object']->transactions as $transaction)
            @if (auth()->user()->can('watch','transactions',$transaction))
            <li>
                <a href="/transactions/show/{{$transaction->id}}">[{{$transaction->formated_datetimeof}}] {{$transaction->type->name}} - {{$transaction->formated_sum}}</a>
            </li>
            @endif
            @endforeach
        </ul>
        <a class="out-link" href="/transactions?search-field=assignment&&search-value={{$data['object']->name}}">{{trans('strings.operations.watch-other')}}</a>
    </div>
    @endif

@endsection