@if ($data['object']->documents)
    <div class="object-field">
        <label>{{trans('strings.fields-name.attachments')}}</label>
        <ul class="attachments-list">
        @foreach ($data['object']->documents as $object)
        <li>
            <a href="/documents/download/{{$object->id}}" title="{{trans('strings.operations.download')}}" class="action-button download-button"></a>
            @include('module-objects.documents.document-preview')
        </li>
        @endforeach
        </ul>
    </div>
@endif