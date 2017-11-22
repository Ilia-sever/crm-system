@include ('layouts.header')

<meta name="csrf-token" content="{{ csrf_token() }}" />

@if (isset($data)) @if (isset($data['success']))
<p class="message">{{trans('strings.messages.success')}}</p>
@endif @endif

<div class="container-fluid wrapper">
    <header class="row header">
        <div class="logo">
            <img src="{{URL::asset('images/logo3.png')}}">
            <span>high level automatization</span>
        </div>
        <nav class="navigation">
            <ul>
                <li><a class="navigation__link navigation__link_help" href="/help"></a></li>
                <li class="acount-container">
                    <a class="navigation__link navigation__link_acount"></a>
                    <div class="acount-panel">
                        <p class="acount-panel__title">{{ Auth::user()->firstname }}</p>
                        <a class="acount-panel__link" href="/employees/show/{{ Auth::user()->id }}">{{trans('strings.operations.acount')}}</a>
                        <a class="acount-panel__link acount-panel__link_logout">{{trans('strings.operations.logout')}}</a>
                        <form class="acount-panel__form" method="POST" action="{{ route('logout') }}">{{ csrf_field() }}</form>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <a class="fancybox-init" href="#fancybox-content"></a>
    <div id="fancybox-content"></div>
    <div class="row main">
        @include ('layouts.aside-panel')
        <section class="content col-xs-12 col-md-10">