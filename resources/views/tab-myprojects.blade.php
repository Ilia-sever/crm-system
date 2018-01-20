<div class="myprojects">
    <div class="table-wrapper">
        <table class="records-table table table-bordered">
            <thead>
                <tr>
                    @foreach ($data['projects-common-fields'] as $field)
                    <th>
                        {{trans('strings.fields-name.'. $field)}}
                    </th>
                    @endforeach
                    <th>{{trans('strings.fields-name.actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @if ($data['projects-records'])
                @foreach ($data['projects-records'] as $object)
                <tr class="records-table__row">
                    @foreach ($data['projects-common-fields'] as $field)
                    <td>
                    @php $formated_field = 'formated_'.$field; @endphp 
                    @if ($object->$formated_field)
                    {{$object->$formated_field}}
                    @else
                    {{$object->$field}}
                    @endif
                    </td>
                    @endforeach
                    <td class="actions-cell unindent">
                        <div class="actions-group">
                        <a href="/projects/show/{{$object->id}}" title="{{trans('strings.operations.detail')}}" class="action-button show-button"></a>
                        </div>
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
    </div>
    <a href="/projects">{{trans('strings.operations.watch-other')}}</a>
</div>