<div class="form-group attachments">
    <label>{{trans('strings.fields-name.attachments')}}</label>
    @if ($data['object']->documents) 
    @foreach($data['object']->documents as $document)
    <div class="attachments__item">
        <input type="hidden" name="attachments[]" value="{{$document->id}}">
        <p>{{$document->name}}</p>
        <button class="attachments__delete action-button delete-button"></button>
    </div>
    @endforeach 
    @endif
    <div class="attachments__item attachments__example">
        <input type="hidden" name="attachments[]">
        <p></p>
        <button class="attachments__delete action-button delete-button"></button>
    </div>
    <button class="attachments__add action-button add-button"></button>
</div>