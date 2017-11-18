@extends ('layouts.master') @section ('content')
<h1>{{trans('strings.modules.home')}}</h1>
<div id="tabs">
    <ul>
        @foreach ($data['tabs'] as $number => $tab)
        <li><a href="#tab-{{$number}}">{{$tab['name']}}</a></li>
        @endforeach
    </ul>
    @foreach ($data['tabs'] as $number => $tab)
    <div id="tab-{{$number}}">{!! $tab['content'] !!}</div>
    @endforeach
</div>

@endsection