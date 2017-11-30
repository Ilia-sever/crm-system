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
<div class="form-group">
    <label>{{trans('strings.fields-name.assignment')}}</label>
    <div class="radio">
        <label>
            <input type="radio" name="workarea_id" class="assignment__radio assignment__radio_workarea" @if ($data['object']->workarea_id) checked @endif/>{{trans('strings.fields-name.workarea')}}</label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="stage_id" class="assignment__radio assignment__radio_stage" @if ($data['object']->stage_id) checked @endif/>{{trans('strings.fields-name.stage')}}</label>
    </div>
    <input type="text" class="assignment__input @if ($data['object']->stage_id) hidden @endif form-control" name="workarea_id" value="{{$data['object']->workarea_id}}">
    <input type="text" class="assignment__input @if ($data['object']->workarea_id) hidden @endif form-control" name="stage_id" value="{{$data['object']->stage_id}}">
</div>
<div class="form-group">
    <label>{{trans('strings.fields-name.executor')}}</label>
    <select class="form-control" name="executor_id">
        @foreach($data['employees'] as $employee)
        <option value="{{$employee->id}}" @if ($data['object']->executor_id==$employee->id) selected @endif>{{$employee->getFullname()}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label>{{trans('strings.fields-name.description')}}</label>
    <textarea class="form-control" name="description">{{$data['object']->description}}</textarea>
</div>
@endsection