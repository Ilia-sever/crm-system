<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="{{URL::asset('css/lib/normalize.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/lib/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/lib/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/lib/jquery.fancybox.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <title>CRM</title>
</head>

<body>

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
                    <li><a class="navigation__link navigation__link_user" href="/help"></a></li>
                </ul>
            </nav>
        </header>
        <a class="fancybox-init" href="#fancybox-content"></a>
        <div id="fancybox-content"></div>
        <div class="row main">
            @include ('layouts.aside-panel')
            <section class="content col-xs-12 col-md-10">