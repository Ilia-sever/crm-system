<form class="stage-form">
	<h2>{{$data['title']}}</h2>
	{{csrf_field()}}
	@include('layouts.form-errors')
	<input type="hidden" name="id" value="{{$data['object']->id}}"/>
	<input type="hidden" name="flow_id" value="{{$data['object']->flow_id or $data['flow_id']}}"/>
	<div class="form-group ">
	    <label>{{trans('strings.fields-name.name')}}</label>
	    <input type="text" class="form-control" name="name" value="{{$data['object']->name}}">
	</div>
	<div class="form-group">
    <label>{{trans('strings.fields-name.status')}}</label>
	    <select class="form-control" name="status">
	        <option value="began" @if ($data['object']->status=='began' ) selected @endif>{{trans('strings.fields-name.stage-statuses.began')}}</option>
	        <option value="complete" @if ($data['object']->status=='complete' ) selected @endif>{{trans('strings.fields-name.stage-statuses.complete')}}</option>
	    </select>
	</div>
	<div class="form-group ">
	    <label>{{trans('strings.fields-name.sort_order')}}</label>
	    <input type="text" class="form-control" name="sort_order" value="{{$data['object']->sort_order}}">
	</div>

	<button class="stage-save btn btn-default">{{trans('strings.operations.save')}}</button>
	<button class="flows-stages-back btn btn-default">{{trans('strings.operations.back')}}</button>

</form>