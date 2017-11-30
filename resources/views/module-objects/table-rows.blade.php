@if ($data['records'])
@foreach ($data['records'] as $object)
<tr class="records-table__row">
    <td>
        @if (auth()->user()->can('delete',"$module_code",$object))
        <input type="checkbox" class="checkbox-table" value="{{$object['id']}}">
        @else
        <input type="checkbox" class="checkbox-table" disabled>
        @endif
    </td>
    @foreach ($data['common-fields'] as $field)
    <td>
    {{$object->$field}}
    </td>
    @endforeach
    <td>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <a href="/{{$module_code}}/show/{{$object->id}}" title="{{trans('strings.operations.detail')}}" class="show-button">👁</a>
        @if (auth()->user()->can('update',"$module_code",$object))
        <a href="/{{$module_code}}/edit/{{$object->id}}" title="{{trans('strings.operations.edit')}}" class="edit-button">✎</a>
        @endif
        @if (auth()->user()->can('delete',"$module_code",$object))
        <a class="delete-button" title="{{trans('strings.operations.delete')}}" name="{{$object->id}}">✖</a>
        @endif
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