<?php

namespace App\Http\Controllers\Modules\Internal;

use Illuminate\Http\Request;
use App\Models\Modules\Internal\Flow;
use App\Models\Modules\Internal\Stage;

use Validator;

class StagesController extends \App\Http\Controllers\Controller
{

	protected $validation_arr = array(
        'name' => 'min:3|max:100|required',
        'status' => 'min:3|max:100|required',
        'sort_order' => 'numeric|nullable|max:100'
    );

    public function control($flow_id,$id) {

    	if ($id) {

    		$stage = Stage::find($id);

            if (!$stage) return;

    		$data = array(
    			'title' => trans('strings.operations.edit-stage').' ('.$stage->getFlow()->name.') ',
    			'id' => $stage->id,
    			'flow_id' => $stage->flow_id,
    			'name' => $stage->name,
                'status' => $stage->status,
    			'sort_order' => $stage->sort_order
    		);

    	} else {

            if (!$flow_id) return;

            $flow = Flow::find($flow_id);

    		$data = array(
    			'title' => trans('strings.operations.add-stage').' ('.$flow->name.') ',
    			'id' => '',
    			'flow_id' => $flow_id,
    			'name' => '',
                'status' => '',
    			'sort_order' => ''
    		);
    	}

    	return view('module-objects.projects.stages.control',compact('data'));
    }

    public function save() {

    	$validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();

        if ($errors->all()) {

            $data = array(
                'title' => trans('strings.operations.add-stage'),
                'id' => request('id'),
                'flow_id' => request('flow_id'),
                'name' => request('name'),
                'status' => request('status'),
                'sort_order' => request('sort_order')
            );


            return view('module-objects.projects.stages.control',compact('data'))->withErrors($validator);
        }

        if (!request('id')) {

            Stage::createObject(request()->all());

        } else {

            $stage = Stage::find(request('id'));
        	
            $stage->updateObject(request()->all());
        	
        }

        return '';
    }

    public function delete() {

    	$stage = Stage::find(request('deleting'));
        $stage->delete();

    }

}
