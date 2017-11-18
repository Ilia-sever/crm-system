<?php

namespace App\Http\Controllers\Modules\Internal;

use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Modules\Internal\Flow;
use App\Models\Modules\Internal\Stage;

use Validator;

class FlowsController extends \App\Http\Controllers\Controller
{

	protected $validation_arr = array(
        'name' => 'min:3|max:100|required',
        'sort_order' => 'numeric|nullable|max:100'
    );

    public function control($project_id,$id) {

    	if ($id) {
    		$flow = Flow::find($id);
    		$data = array(
    			'title' => trans('strings.operations.edit-flow'),
    			'id' => $flow->id,
    			'project_id' => $flow->project_id,
    			'name' => $flow->name,
    			'sort_order' => $flow->sort_order

    		);
    	} else {
    		$data = array(
    			'title' => trans('strings.operations.add-flow'),
    			'id' => '',
    			'project_id' => $project_id,
    			'name' => '',
    			'sort_order' => ''
    		);
    	}

    	return view('module-objects.projects.flows.control',compact('data'));
    }

    public function save() {

    	$validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();

        if (!$errors->all()) {

        	if (request('id')) {

	            Flow::find(request('id'))->update([
	                'name' => request('name'),
	                'sort_order' => request('sort_order')
	            ] );

	            return '';

        	} else {
        		Flow::create([
	                'name' => request('name'),
	                'sort_order' => request('sort_order')
	            ] );

	            return Flow::getNew();
        	}

    	} else {

    		$data = array(
    			'title' => trans('strings.operations.add-flow'),
    			'id' => request('id'),
    			'project_id' => request('project_id'),
    			'name' => request('name'),
    			'sort_order' => request('sort_order')
    		);


    		return view('module-objects.projects.flows.control',compact('data'))->withErrors($validator);
    	}
 
    }

    public function delete() {

    	Flow::find(request('deleting'))->delete();
    	Stage::where('flow_id',request('deleting'))->delete();

    }

}
