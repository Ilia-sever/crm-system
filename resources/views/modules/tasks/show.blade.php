@extends ('modules.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']->id}}">
    <div class="object-field">
        <label>{{trans('strings.fields-name.name')}}</label>
        <p class="text-info">{{$data['object']->name}}</p>
    </div>
    <div class="object-field">
        <label>{{trans('strings.fields-name.status')}}</label>
        <p class="text-info">{{$data['object']->formated_status}}</p>
    </div>
    <div class="object-field">
        <label>{{trans('strings.fields-name.deadline')}}</label>
        <p class="text-info">{{$data['object']->formated_deadline}}</p>
    </div>
    <div class="object-field">
        <label>{{trans('strings.fields-name.plaintime')}}</label>
        <p class="text-info">{{$data['object']->formated_plaintime}}</p>
    </div>
    <div class="object-field">
        <label>{{trans('strings.fields-name.assignment')}}</label>
        <p class="text-info">
        @if ($data['object']->stage)
        @if ($data['object']->stage->project->isActive())
        <a href="/projects/show/{{$data['object']->stage->project->id}}">{{$data['object']->stage->project->name}}</a> - {{$data['object']->stage->flow->name}} - {{$data['object']->stage->name}}
        @endif
        @elseif ($data['object']->workarea)
        <a href="/workareas/show/{{$data['object']->workarea->id}}">{{$data['object']->workarea->name}}</a>
        @else
        {{trans('strings.fields-name.assignment-none')}}
        @endif
        </p>
    </div>
    <div class="object-field">
        <label>{{trans('strings.fields-name.director')}}</label>
        <p class="text-info"><a href="/employees/show/{{$data['object']->director->id}}">{{$data['object']->director}}</a></p>
    </div>

    <div class="object-field">
        <label>{{trans('strings.fields-name.executor')}}</label>
        <p class="text-info"><a href="/employees/show/{{$data['object']->executor->id}}">{{$data['object']->executor}}</a></p>
    </div>

    <div class="object-field">
        <label>{{trans('strings.fields-name.description')}}</label>
        <p class="text-info">{{$data['object']->description}}</p>
    </div>

    @include('modules.documents.attachments-list')

@endsection