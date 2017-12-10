@extends ('layouts.master') @section ('content')

<h1>{{trans('strings.operations.transaction-types')}}</h1>

<form action="/transactions/types/save" method="POST" class="object-form transaction-types-form">

    {{csrf_field()}}

    <div class="errors">
        @include('layouts.form-errors')
    </div>

    <table class="multitable">
        <thead>
        <tr>
            <th>{{trans('strings.fields-name.name')}}</th>
            <th>{{trans('strings.fields-name.income')}}</th>
            <th>{{trans('strings.fields-name.indicate-project')}}</th>
            <th>{{trans('strings.fields-name.indicate-client')}}</th>
            <th>{{trans('strings.fields-name.indicate-employee')}}</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr class="multitable__row multitable__example">
            <td>
                <input type="text" class="form-control" name="types_name">
            </td>
            <td>
                <input type="checkbox" class="form-control" name="types_income">
            </td>
            <td>
                <input type="checkbox" class="form-control" name="types_indicate_project">
            </td>
            <td>
                <input type="checkbox" class="form-control" name="types_indicate_client">
            </td>
            <td>
                <input type="checkbox" class="form-control" name="types_indicate_employee">
            </td>
            <td>
                <button class="multitable__delete action-button delete-button"></button>
            </td>
        </tr>
        @if ($data['transaction_types']) @foreach($data['transaction_types'] as $transaction_type)
        <tr class="multitable__row">
            <td>
                <input type="text" class="form-control" name="types_name[{{$transaction_type->id}}]" value="{{$transaction_type->name}}">
            </td>
            <td>
                <input type="checkbox" class="form-control" name="types_income[{{$transaction_type->id}}]" @if ($transaction_type->income) checked @endif>
            </td>
            <td>
                <input type="checkbox" class="form-control" name="types_indicate_project[{{$transaction_type->id}}]" @if ($transaction_type->indicate_project) checked @endif >
            </td>
            <td>
                <input type="checkbox" class="form-control" name="types_indicate_client[{{$transaction_type->id}}]" @if ($transaction_type->indicate_client) checked @endif ">
            </td>
            <td>
                <input type="checkbox" class="form-control" name="types_indicate_employee[{{$transaction_type->id}}]" @if ($transaction_type->indicate_employee) checked @endif ">
            </td>
            <td>
                <button class="multitable__delete action-button delete-button"></button>
            </td>
        </tr>
        @endforeach @endif
        <tr class="multitable__final">
            <td colspan="100">
                <button value="1" class="multitable__add action-button add-button"></button>
            </td>
        </tr>
        </tbody>
    </table>

    <div class="button-notice">
        <span>{{trans('strings.messages.delete-cascade')}}</span>
    </div>
    <button type="submit" class="btn btn-default module-button">{{trans('strings.operations.save')}}</button>
    

</form>
@endsection