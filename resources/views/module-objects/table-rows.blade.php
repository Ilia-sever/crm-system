@if ($data['records'])
@foreach ($data['records'] as $object)
<tr class="records-table__row">
    <td>
        <input type="checkbox" class="checkbox-table" value="{{$object['id']}}">
    </td>
    @foreach ($data['common-fields'] as $field)
    <td>
    @if (isset($object[$field]))
        {{$object[$field]}}
    @endif
    </td>
    @endforeach
    <td>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <a href="/{{$data['module-code']}}/show/{{$object['id']}}" title="{{trans('strings.operations.detail')}}" class="show-button">👁</a>
        <a href="/{{$data['module-code']}}/edit/{{$object['id']}}" title="{{trans('strings.operations.edit')}}" class="edit-button">✎</a>
        <a class="delete-button" title="{{trans('strings.operations.delete')}}" name="{{$object['id']}}">✖</a>
    </td>
</tr>
@endforeach
@if (isset($data['pagination'])) 
<tr class="records-table__row_empty">
    <td colspan=100>
        <ul class="pagination">
        @for ($i = 1; $i <= $data['pagination']['count']; $i++)
            @if ($i == $data['pagination']['current'])
            <li><button class="pagination__button pagination__button_active">{{$i}}</button></li>
            @else
            <li><button class="pagination__button">{{$i}}</button></li>
            @endif
        @endfor
        </ul>
    </td>
</tr>
@endif
@else 
<tr class="records-table__row_empty">
    <td colspan=100>{{trans('strings.messages.empty')}}</td>
</tr>
@endif