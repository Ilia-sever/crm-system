@extends ('modules.common-control') @section ('object-control')
<div class="form-group ">
    <label>{{trans('strings.fields-name.name')}}</label>
    <input type="text" class="form-control" name="name" value="{{$data['object']->name}}">
</div>
<div class="form-group ">
    <label>{{trans('strings.fields-name.site')}}</label>
    <input type="text" class="form-control" name="site" value="{{$data['object']->site}}">
</div>

<div class="form-group">
    <label>{{trans('strings.fields-name.manager')}}</label>
    <select class="form-control select-plus" name="manager_id">
        <option value="">{{trans('strings.messages.select')}}</option>
        @foreach($data['managers'] as $manager)
        <option value="{{$manager->id}}" @if ($data['object']->manager_id==$manager->id) selected @endif>{{$manager}}</option>
        @endforeach
    </select>
</div>

@endsection