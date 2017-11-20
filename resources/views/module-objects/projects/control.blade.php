@extends ('module-objects.common-control') @section ('object-control')

<div class="form-group ">
    <label>{{trans('strings.fields-name.name')}}</label>
    <input type="text" class="form-control" name="name" value="{{$data['object']['name']}}">
</div>

<div class="form-group">
    <label>{{trans('strings.fields-name.client')}}</label>
    <select class="form-control" name="client_id">
        @foreach($data['employees'] as $employee)
        <option value="{{$employee['id']}}" @if ($data[ 'object'][ 'client_id']==$employee[ 'id']) selected @endif>{{$employee->getFullname()}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label>{{trans('strings.fields-name.manager')}}</label>
    <select class="form-control" name="manager_id">
        @foreach($data['employees'] as $employee)
        <option value="{{$employee['id']}}" @if ($data[ 'object'][ 'manager_id']==$employee[ 'id']) selected @endif>{{$employee->getFullname()}}</option>
        @endforeach
    </select>
</div>

<div class="form-group flows-stages">
    <label>{{trans('strings.fields-name.flows-stages')}}</label>
    <input type="hidden" name="flows" value="{{$data['flows']}}">
    <button class="flows-stages__control">{{trans('strings.operations.edit')}}</button>

</div>

@endsection