@extends ('module-objects.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']->id}}">
    <div class="object-field">
        <label>{{trans('strings.fields-name.name')}}</label>
        <p class="text-info" name="name">{{$data['object']->name}}</p>
    </div>
    <div class="object-field">
        <label>{{trans('strings.fields-name.tasks')}}</label>
        @foreach($data['object']->tasks as $task)
        <a href="/tasks/show/{{$task->id}}">{{$task->name}}</a>
        @endforeach
    </div>
    
   

@endsection