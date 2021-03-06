<form class="flow-form">
	<h2>{{$data['title']}}</h2>
	{{csrf_field()}}
	@include('layouts.form-errors')
	<input type="hidden" name="id" value="{{$data['object']->id}}"/>
	<input type="hidden" name="project_id" value="{{$data['object']->project_id or $data['project_id']}}"/>
	<div class="form-group ">
	    <label>{{trans('strings.fields-name.name')}}</label>
	    <input type="text" class="form-control" name="name" value="{{$data['object']->name}}">
	</div>
	<div class="form-group ">
	    <label>{{trans('strings.fields-name.sort_order')}}</label>
	    <input type="text" class="form-control" name="sort_order" value="{{$data['object']->sort_order}}">
	</div>

	<button class="flow-save btn btn-default">{{trans('strings.operations.save')}}</button>
	<button class="flows-stages-back btn btn-default">{{trans('strings.operations.back')}}</button>

</form>