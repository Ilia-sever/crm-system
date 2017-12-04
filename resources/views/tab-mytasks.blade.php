<div class="mytasks">
    <table class="records-table table table-bordered">
        <thead>
            <tr>
                @foreach ($data['tasks-common-fields'] as $field)
                <th>
                    {{trans('strings.fields-name.'. $field)}}
                </th>
                @endforeach
                <th>{{trans('strings.fields-name.actions')}}</th>
            </tr>
        </thead>
        <tbody>
            @if ($data['tasks-records'])
            @foreach ($data['tasks-records'] as $object)
            <tr class="records-table__row">
                @foreach ($data['tasks-common-fields'] as $field)
                <td>
                @php $formated_field = 'formated_'.$field; @endphp 
                @if ($object->$formated_field)
                {{$object->$formated_field}}
                @else
                {{$object->$field}}
                @endif
                </td>
                @endforeach
                <td>
                    <a class="action-button complete-button" title="{{trans('strings.operations.done')}}" name="{{$object->id}}"></a>
                    <a href="/tasks/show/{{$object->id}}" title="{{trans('strings.operations.detail')}}" class="action-button show-button"></a>
                </td>
            </tr>
            @endforeach
            @else 
            <tr class="records-table__row_empty">
                <td colspan=100>{{trans('strings.messages.empty')}}</td>
            </tr>
            @endif
        </tbody>
    </table>
    <a href="/tasks?search-field=executor&&search-value={{auth()->user()->employee()->fullname}}">{{trans('strings.operations.watch-other')}}</a>
</div>