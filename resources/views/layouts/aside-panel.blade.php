<aside class="aside-panel col-xs-12 col-md-2">
    <ul class="modules-list">

        
        <li class="modules-list__item @if($module_code == 'home') modules-list__item_selected @endif modules-list__item_home">
            <img src="{{URL::asset('images/module-icons/home.png')}}">
            <a href="/">{{trans('strings.modules.home')}}</a>
        </li>

        @foreach ($modules as $module)

        @if (auth()->user()->can('watch',$module))        
        <li class="modules-list__item @if($module_code == $module) modules-list__item_selected @endif modules-list__item_{{$module}}">
            <img src="{{URL::asset('images/module-icons/'.$module.'.png')}}">
            <a href="/{{$module}}">{{trans_choice('strings.modules.'.$module,2)}}</a>
        </li>
        @endif

        @endforeach

    </ul>
    <button class="aside-panel__control"></button>
</aside>