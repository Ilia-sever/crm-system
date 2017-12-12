<div class="document-preview">
    @if ($object->isImage())
    <a href="/documents/show/{{$object->id}}" title="{{trans('strings.operations.open-real-size')}}" class="show-documents"><img src="/documents/show/{{$object->id}}"></a> 
    @else
    <a><img src='/images/file.png'><span>{{$object->extension}}</span></a> 
    @endif
    <p>{{$object->name}}</p>
</div>