<?php

namespace App\Http\Controllers\Modules\Internal;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;

class StagesController extends \App\Http\Controllers\Controller
{

	protected $validation_arr = array(
        'name' => 'min:3|max:100|required',
        'status' => 'min:3|max:100|required',
        'sort_order' => 'numeric|nullable|max:100'
    );

    public function control($flow_id,$id) {

        $stage = ($id) ? Modules\Internal\Stage::find($id) : null;

        $flow = ($flow_id) ? Modules\Internal\Flow::find($flow_id) : Modules\Internal\Flow::find($stage->flow->id);

        if (!$this->checkAccess($flow)) return;

    	if ($id) {

            if (!$stage) return;

    		$data = array(
    			'title' => trans('strings.operations.edit-stage').' ('.$flow->name.') ',
    			'id' => $stage->id,
    			'flow_id' => $stage->flow_id,
    			'name' => $stage->name,
                'status' => $stage->status,
    			'sort_order' => $stage->sort_order
    		);

    	} else {

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

        $flow = Modules\Internal\Flow::find(request('flow_id'));

        if (!$this->checkAccess($flow)) return;

    	$validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();

        if ($errors->all()) {

            $data = array(
                'title' => (request('id')) ? trans('strings.operations.edit-stage') : trans('strings.operations.add-stage'),
                'id' => request('id'),
                'flow_id' => request('flow_id'),
                'name' => request('name'),
                'status' => request('status'),
                'sort_order' => request('sort_order')
            );


            return view('module-objects.projects.stages.control',compact('data'))->withErrors($validator);
        }

        if (!request('id')) {

            Modules\Internal\Stage::createObject(request()->all());

        } else {

            $stage = Modules\Internal\Stage::find(request('id'));
        	
            $stage->updateObject(request()->all());
        	
        }

        return '';
    }

    public function delete() {

    	$stage = Modules\Internal\Stage::find(request('deleting'));

        $flow = Modules\Internal\Flow::find($stage->flow_id);

        if (!$this->checkAccess($flow)) return;

        $stage->delete();

    }

    public function checkAccess($flow) {

        if (!$flow) return false;

        if ($flow->project) {

            if (!auth()->user()->can('update','projects',Modules\Project::find($flow->project->id))) return false;

        } else {

            if (!auth()->user()->can('create','projects')) return false;
        }

        return true;
    }

}
