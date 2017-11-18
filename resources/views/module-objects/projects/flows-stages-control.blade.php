<div class="form-group flows-modal">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <label>{{trans('strings.fields-name.flows')}}:</label>
    <div class="flows-list">
        @if (isset($data['flows'])) @foreach ($data['flows'] as $flow)
        <div class="flow-item">
            <span class="flow-item__title">{{$flow->name}}</span>
            <button value="{{$flow->id}}" class="flow-item__edit">✎</button>
            <button value="{{$flow->id}}" class="flow-item__delete">✖</button>
        </div>
        <div class="stages-panel">
            <label>{{trans('strings.fields-name.stages')}}:</label>
            <ul class="stages-list">
                @foreach ($flow->getStages() as $stage)
                <li class="stage-item">
                    <span class="stage-item__title">{{$stage->name}}</span>
                    <button value="{{$stage->id}}" class="stage-item__edit">✎</button>
                    <button value="{{$stage->id}}" class="stage-item__delete">✖</button>
                </li>
                @endforeach      
            </ul>
            <button value="{{$flow->id}}" class="stages-add">{{trans('strings.operations.add-stage')}}</button>
        </div>
        @endforeach @endif
    </div>
    <button class="flows-add">{{trans('strings.operations.add-flow')}}</button>
</div>