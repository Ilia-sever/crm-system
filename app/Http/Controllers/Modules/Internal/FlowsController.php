<?php

namespace App\Http\Controllers\Modules\Internal;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;

class FlowsController extends \App\Http\Controllers\Controller
{

    protected $validation_arr = array(
        'name' => 'min:3|max:100|required',
        'sort_order' => 'numeric|nullable|max:100'
    );

    public function control($project_id,$id) {

        if ($project_id) {

            if (!auth()->user()->can('update','projects',Modules\Project::find($project_id))) return;

        } else {

            if (!auth()->user()->can('create','projects')) return;

        }

        if ($id) {

            $flow = Modules\Internal\Flow::find($id);

            if (!$flow) return;

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

        if ($errors->all()) {

            $data = array(
                'title' => (request('id')) ? trans('strings.operations.edit-flow') : trans('strings.operations.add-flow'),
                'id' => request('id'),
                'project_id' => request('project_id'),
                'name' => request('name'),
                'sort_order' => request('sort_order')
            );


            return view('module-objects.projects.flows.control',compact('data'))->withErrors($validator);
        }

        if (request('project_id')) {

            if (!auth()->user()->can('update','projects',Modules\Project::find(request('project_id')))) return;

        } else {

            if (!auth()->user()->can('create','projects')) return;

        }

        if (!request('id')) {

            $newflow = Modules\Internal\Flow::createObject(request()->all());
            return $newflow->id;

        }

        $flow = Modules\Internal\Flow::find(request('id'));

        if ($flow) {

            $flow->updateObject(request()->all());
        }

        return ''; 
    }

    public function delete() {

        $flow = Modules\Internal\Flow::find(request('deleting'));

        if (!$flow) return;

        if ($flow->project) {

            if (!auth()->user()->can('update','projects',Modules\Project::find($flow->project->id))) return;

        } else {

            if (!auth()->user()->can('create','projects')) return;

        }

        $flow->deleteStages();
        $flow->delete();
    }

}
