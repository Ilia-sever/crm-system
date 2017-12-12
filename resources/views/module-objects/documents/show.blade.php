@extends ('module-objects.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']->id}}">
    <div class="object-field">
        <label>{{trans('strings.fields-name.type')}}</label>
        <p class="text-info">{{$data['object']->type}}</p>
    </div>

    <div class="object-field">
        <label>{{trans('strings.fields-name.sum')}}</label>
        <p class="text-info">{{$data['object']->formated_sum}}</p>
    </div>

    <div class="object-field">
        <label>{{trans('strings.fields-name.datetimeof')}}</label>
        <p class="text-info">{{$data['object']->formated_datetimeof}}</p>
    </div>

    @if ($data['object']->project)
    <div class="object-field">
        <label>{{trans('strings.fields-name.project')}}</label>
        <p class="text-info"><a href="/projects/show/{{$data['object']->project_id}}">{{$data['object']->project}}</a></p>
    </div>
    @endif


    @if ($data['object']->client)
    <div class="object-field">
        <label>{{trans('strings.fields-name.client')}}</label>
        <p class="text-info"><a href="/clients/show/{{$data['object']->client_id}}">{{$data['object']->client}}</a></p>
    </div>
    @endif

    @if ($data['object']->employee)
    <div class="object-field">
        <label>{{trans('strings.fields-name.employee')}}</label>
        <p class="text-info"><a href="/employees/show/{{$data['object']->employee_id}}">{{$data['object']->employee}}</a></p>
    </div>
    @endif

    <div class="object-field">
        <label>{{trans('strings.fields-name.comment')}}</label>
        <p class="text-info">{{$data['object']->comment}}</p>
    </div>

@endsection