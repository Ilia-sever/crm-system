@extends ('layouts.master') @section ('content')
@include('layouts.delete-confirmation')
<meta id="module-code" value="{{$module_code}}">
<h1>{{trans_choice('strings.modules.' . $module_code,2)}}</h1>
@includeIf('modules.'.$module_code.'.index-additional')
@if (auth()->user()->can('create',"$module_code"))
<a href="/{{$module_code}}/add/">
    <button type="button" class="create-button btn btn-success" id="create-{{$module_code}}">{{trans('strings.operations.add')}}</button>
</a>
@endif
<div class="search">
    <div class="input-group search-input">
        <input type="text" class="form-control" value="{{request('search-value')}}">
        <button id="search-start" class="input-group-addon">{{trans('strings.operations.search')}}</button>
    </div>
    <div class="form-group search-select">
        <label for="search-field">{{trans('strings.operations.search-by')}}</label>
        <select class="form-control">
            <option value="all">{{trans('strings.fields-name.all')}}</option>
            @foreach ($data['common-fields'] as $field)
            <option value="{{$field}}" @if (request('search-field')==$field) selected @endif>{{trans('strings.fields-name.'. $field)}}</option>
            @endforeach
        </select>
    </div>
    
</div>
<div class="table-wrapper">
    <table class="records-table table table-bordered">
        <thead>
            <tr>
                <th class="checkbox-cell">
                    <input type="checkbox" class="checkbox-main">
                </th>
                @foreach ($data['common-fields'] as $field)
                <th>
                    {{trans('strings.fields-name.'. $field)}}
                    <a class="sort-button" id="{{$field}}" value="desc"></a>
                </th>
                @endforeach
                <th class="actions-cell">{{trans('strings.fields-name.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            <tr class="records-table__row_empty">
                <td colspan=100>{{trans('strings.messages.loading')}}</td>
            </tr>
        </tbody>
    </table>
</div>
@if (auth()->user()->can('delete',"$module_code"))
<button type="button" class="btn delete-all-button btn-danger">
    {{trans('strings.operations.delete-selected')}}
</button>
@endif
@endsection