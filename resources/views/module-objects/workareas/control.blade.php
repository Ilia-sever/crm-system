@extends ('module-objects.common-control') @section ('object-control')

    <div class="form-group">
        <label>{{trans('strings.fields-name.name')}}</label>
        <input type="text" class="form-control" name="name" value="{{$data['object']->name}}">
    </div>
    
@endsection