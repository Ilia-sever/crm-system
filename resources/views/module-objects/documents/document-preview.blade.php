<div class="document-preview">
	@if ($object->isFileExist())
	    @if ($object->isImage())
	    <a href="/documents/show/{{$object->id}}" title="{{trans('strings.operations.open-real-size')}}" class="show-documents"><img src="/documents/show/{{$object->id}}"></a> 
	    @else
	    <a><img src='/images/file.png'><span>{{$object->extension}}</span></a> 
	    @endif
	@else
	    <a><img src='/images/no_file.png'></a> 
    @endif
    <p class="document-name">{{$object->name}}</p>
</div>