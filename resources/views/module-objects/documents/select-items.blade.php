@if ($data['select-items'])
@foreach($data['select-items'] as $object)
<li class="document-select-list__item">
	<span class="hidden document-id">{{$object->id}}</span>
	@include('module-objects.documents.document-preview')
	<p>{{$object->datetimeof}}</p>

</li>
@endforeach
@else
<p>{{trans('strings.messages.empty')}}</p>
@endif