@extends ('modules.common-control') @section ('object-control')

<div class="form-group ">
    <label>{{trans('strings.fields-name.name')}}</label>
    <input type="text" class="form-control" name="name" value="{{$data['object']->name}}">
</div>

<div class="form-group">
    <label>{{trans('strings.fields-name.client')}}</label>
    <select class="form-control select-plus" name="client_id">
        <option value="">{{trans('strings.messages.select')}}</option>
        @foreach($data['clients'] as $client)
        <option value="{{$client->id}}" @if ($data['object']->client_id==$client->id) selected @endif>{{$client}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>{{trans('strings.fields-name.manager')}}</label>
    <select class="form-control select-plus" name="manager_id">
        @foreach($data['employees'] as $employee)
        <option value="{{$employee->id}}" @if ($data['object']->manager_id==$employee->id) selected @endif>{{$employee}}</option>
        @endforeach
    </select>
</div>

<div class="form-group flows-stages">
    <label>{{trans('strings.fields-name.flows-stages')}}</label>
    <input type="hidden" name="flows_list" value="{{$data['object']->flows_list}}">
    <button class="flows-stages__control">{{trans('strings.operations.edit')}}</button>
</div>

@include('modules.documents.attachments-field')

@endsection