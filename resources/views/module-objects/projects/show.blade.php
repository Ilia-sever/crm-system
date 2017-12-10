@extends ('module-objects.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']->id}}">
    <div class="object-field">
        <label>{{trans('strings.fields-name.name')}}</label>
        <p class="text-info">{{$data['object']->name}}</p>
    </div>

    <div class="object-field">
        <label>{{trans('strings.fields-name.client')}}</label>
        @if ($data['object']->client)
        <p class="text-info"><a href="/clients/show/{{$data['object']->client->id}}">{{$data['object']->client}}</a></p>
        @endif
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

    @if ($data['object']->transactions) 
    <div class="object-field">
        <label>{{trans('strings.fields-name.transactions')}}</label>
        <ul class="text-info text-info_full">
            @foreach ($data['object']->transactions as $transaction)
            @if (auth()->user()->can('watch','transactions',$transaction))
            <li>
                <a href="/transactions/show/{{$transaction->id}}">[{{$transaction->formated_datetimeof}}] {{$transaction->type->name}} - {{$transaction->formated_sum}}</a>
            </li>
            @endif
            @endforeach
        </ul>
        <a class="out-link" href="/transactions?search-field=assignment&&search-value={{$data['object']->name}}">{{trans('strings.operations.watch-other')}}</a>
    </div>
    @endif
    
@endsection