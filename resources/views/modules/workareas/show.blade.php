@extends ('modules.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']->id}}">
    <div class="object-field">
        <label>{{trans('strings.fields-name.name')}}</label>
        <p class="text-info" name="name">{{$data['object']->name}}</p>
    </div>
    <div class="object-field">
        <label>{{trans('strings.fields-name.tasks')}}</label>
        <ul class="text-info text-info_full">
        @foreach($data['object']->tasks as $task)
        <li>
            <a href="/tasks/show/{{$task->id}}">{{$task->name}}</a>
        </li>
        @endforeach
        </ul>
    </div>
    
   

@endsection