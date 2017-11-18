@extends ('module-objects.common-show') @section ('object-show')

    <input type="hidden" name="id" value="{{$data['object']['id']}}">
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.name')}}</label>
        <p class="text-info">{{$data['object']['name']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.client')}}</label>
        <p class="text-info">{{$data['object']['client']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.manager')}}</label>
        <p class="text-info">{{$data['object']['manager_id']}}</p>
    </div>
    <div class="row">
        <label class="col-md-6">{{trans('strings.fields-name.flows-stages')}}</label>
        <div class="flows-panel">
            @foreach ($data['object']['flows'] as $flow)
            <span class="flows-panel__item">{{$flow->name}}</span>
            <ul class="stages-strip">
                @foreach ($flow->getStages() as $stage)
                <li class="stage-block">
                    <span class="stage-block__text">{{$stage->name}}</span>
                    <button class="stage-block__btn">v</button>
                </li>
                @endforeach    
            </ul>
            @endforeach
        </div>
    </div>
    
@endsection