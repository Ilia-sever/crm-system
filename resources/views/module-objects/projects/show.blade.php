@extends ('module-objects.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']->id}}">
    <div class="object-field">
        <label>{{trans('strings.fields-name.name')}}</label>
        <p class="text-info">{{$data['object']->name}}</p>
    </div>

    <div class="object-field">
        <label>{{trans('strings.fields-name.client')}}</label>
        <p class="text-info"><a href="/clients/show/{{$data['object']->client->id}}">{{$data['object']->client}}</a></p>
    </div>
    <div class="object-field">
        <label>{{trans('strings.fields-name.manager')}}</label>
        <p class="text-info"><a href="/employees/show/{{$data['object']->manager->id}}">{{$data['object']->manager}}</a></p>
    </div>
    <div class="object-field">
        <!-- <label>{{trans('strings.fields-name.flows-stages')}}</label> -->
        <div class="flows-panel">
            @foreach ($data['object']->flows as $flow)
            <div class="flows-panel__item">
            <span>{{$flow->name}}</span>
            <ul class="stages-strip">
                @foreach ($flow->getStages() as $stage)
                <li class="stage-block @if ($stage->status=='complete') stage-block_complete @endif">
                    <span class="stage-block__text">{{$stage->name}}</span>
                    @if ($stage->tasks)
                    <button class="stage-block__btn">&#9660;</button>
                    <div class="stage-tasks">
                        <ul>
                            @foreach ($stage->tasks as $task)
                            <li><a href="/tasks/show/{{$task->id}}">{{$task->name}}</a></li>
                            @endforeach
                        </ul> 
                    </div>
                    @endif
                </li>
                @endforeach    
            </ul>
            </div>
            @endforeach
        </div>
    </div>
    
@endsection