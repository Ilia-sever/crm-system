@extends ('module-objects.common-control') @section ('object-control')
<div class="form-group ">
    <label>{{trans('strings.fields-name.name')}}</label>
    <input type="text" class="form-control" name="name" value="{{$data['object']->name}}">
</div>
<div class="form-group">
    <label>{{trans('strings.fields-name.status')}}</label>
    <select class="form-control" name="status">
        <option value="began" @if ($data['object']->status=='began' ) selected @endif>{{trans('strings.fields-name.statuses.began')}}</option>
        <option value="complete" @if ($data['object']->status=='complete' ) selected @endif>{{trans('strings.fields-name.statuses.complete')}}</option>
        <option value="failed" @if ($data['object']->status=='failed' ) selected @endif>{{trans('strings.fields-name.statuses.failed')}}</option>
    </select>
</div>
<div class="form-group">
    <label>{{trans('strings.fields-name.deadline')}}</label>
    <input type="text" class="modal-calendar form-control" name="deadline" value="{{$data['object']->deadline}}" readonly>
</div>
<div class="form-group">
    <label>{{trans('strings.fields-name.plaintime')}}</label>
    <input type="text" class="modal-clock form-control" name="plaintime" value="{{$data['object']->plaintime}}">
</div>
<div class="form-group assignment">
    <label>{{trans('strings.fields-name.assignment')}}</label>
    <div class="radio">
        <label>
            <input type="radio" name="assignment" class="assignment__radio" checked/>{{trans('strings.fields-name.assignment-none')}}
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="assignment" class="assignment__radio assignment__radio_stage" @if ($data['object']->stage_id) checked @endif/>{{trans('strings.fields-name.assignment-stage')}}
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="assignment" class="assignment__radio assignment__radio_workarea" @if ($data['object']->workarea_id) checked @endif/>{{trans('strings.fields-name.assignment-workarea')}}
        </label>
    </div>
    <select class="form-control assignment__select assignment__select_stage @if ($data['object']->stage_id) assignment__select_active @endif" name="stage_id">
        <option value="">{{trans('strings.messages.select')}}</option>
        @foreach($data['projects'] as $project)
        @foreach($project['flows'] as $flow)
        @foreach($flow['stages'] as $stage)
        <option value="{{$stage->id}}" @if ($data['object']->stage_id==$stage->id) selected @endif>{{$project->name}} - {{$flow->name}} - {{$stage->name}}</option>
        @endforeach
        @endforeach
        @endforeach
    </select>
    <select class="form-control assignment__select assignment__select_workarea @if ($data['object']->workarea_id) assignment__select_active @endif" name="workarea_id">
        <option value="">{{trans('strings.messages.select')}}</option>
        @foreach($data['workareas'] as $workarea)
        <option value="{{$workarea->id}}" @if ($data['object']->workarea_id==$workarea->id) selected @endif>{{$workarea->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>{{trans('strings.fields-name.executor')}}</label>
    <select class="form-control" name="executor_id">
        @foreach($data['employees'] as $employee)
        <option value="{{$employee->id}}" @if ($data['object']->executor_id==$employee->id) selected @endif>{{$employee}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>{{trans('strings.fields-name.description')}}</label>
    <textarea class="form-control" name="description">{{$data['object']->description}}</textarea>
</div>
@endsection