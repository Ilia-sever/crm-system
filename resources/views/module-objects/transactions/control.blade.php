@extends ('module-objects.common-control') @section ('object-control')
<div class="form-group">
    <label>{{trans('strings.fields-name.type')}}</label>
    <select class="form-control indication" name="type_id">
        @foreach($data['transaction_types'] as $type)
        <option value="{{$type->id}}" 
            @if ($data['object']->type_id==$type->id) selected @endif
            for="
            @if ($type->indicate_project) indicate_project @endif
            @if ($type->indicate_client) indicate_client @endif
            @if ($type->indicate_employee) indicate_employee @endif
            "
        >{{$type->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group ">
    <label>{{trans('strings.fields-name.sum')}}</label>
    <input type="text" class="form-control" name="sum" value="{{$data['object']->sum}}">
</div>



<div class="form-group indicate indicate_project">
    <label>{{trans('strings.fields-name.project')}}</label>
    <select class="form-control select-plus" name="project_id">
        <option value="">{{trans('strings.messages.select')}}</option>
        @foreach($data['projects'] as $project)
        <option value="{{$project->id}}" @if ($data['object']->project_id==$project->id) selected @endif>{{$project->name}}</option>
        @endforeach
    </select>
</div>


<div class="form-group indicate indicate_client">
    <label>{{trans('strings.fields-name.client')}}</label>
    <select class="form-control select-plus" name="client_id">
        <option value="">{{trans('strings.messages.select')}}</option>
        @foreach($data['clients'] as $client)
        <option value="{{$client->id}}" @if ($data['object']->client_id==$client->id) selected @endif>{{$client}}</option>
        @endforeach
    </select>
</div>


<div class="form-group indicate indicate_employee">
    <label>{{trans('strings.fields-name.employee')}}</label>
    <select class="form-control select-plus" name="employee_id">
        <option value="">{{trans('strings.messages.select')}}</option>
        @foreach($data['employees'] as $employee)
        <option value="{{$employee->id}}" @if ($data['object']->employee_id==$employee->id) selected @endif>{{$employee}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>{{trans('strings.fields-name.comment')}}</label>
    <textarea class="form-control" name="comment">{{$data['object']->comment}}</textarea>
</div>

@endsection