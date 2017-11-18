@extends ('layouts.master') @section ('content')
@include('layouts.delete-confirmation')
<meta id="module-code" value="{{$data['module-code']}}">
<h1>{{trans_choice('strings.modules.' . $data['module-code'],2)}}</h1>
<a href="/{{$data['module-code']}}/add/">
    <button type="button" class="add-button btn btn-success">{{trans('strings.operations.add')}}</button>
</a>
<div class="search">
    <div class="input-group search-input">
        <input type="text" class="form-control" id="exampleInputAmount" value="@if(isset($data['search-value'])){{$data['search-value']}}@endif">
        <button id="search-start" class="input-group-addon">{{trans('strings.operations.search')}}</button>
    </div>
    <div class="form-group search-select">
        <label for="search-field">{{trans('strings.operations.search-by')}}</label>
        <select class="form-control">
            <option value="all">{{trans('strings.fields-name.all')}}</option>
            @foreach ($data['common-fields'] as $field)
            <option value="{{$field}}" @if (isset($data['search-field'])) @if ($data['search-field']==$field) selected @endif @endif>{{trans('strings.fields-name.'. $field)}}</option>
            @endforeach
        </select>
    </div>
    
</div>
<table class="records-table table table-bordered">
    <thead>
        <tr>
            <th>
                <input type="checkbox" class="checkbox-main">
            </th>
            @foreach ($data['common-fields'] as $field)
            <th>
                {{trans('strings.fields-name.'. $field)}}
                <a class="sort-button" id="{{$field}}" value="asc"></a>
            </th>
            @endforeach
            <th>{{trans('strings.fields-name.actions')}}</th>
        </tr>
    </thead>
    <tbody>
        @include('module-objects.table-rows')
    </tbody>
</table>
<button type="button" class="btn delete-all-button btn-danger">
    {{trans('strings.operations.delete-selected')}}
</button>
@endsection