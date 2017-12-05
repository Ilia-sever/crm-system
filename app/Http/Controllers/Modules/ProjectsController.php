<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

class ProjectsController extends ModuleController
{
    protected $model = "\App\Models\Modules\Project";

    protected $module_code = 'projects';
    
    protected $validation_arr = array(
        'name' => 'min:3|max:100|required',
        'client_id' => 'numeric|nullable|max:100',
        'manager_id' => 'numeric|required|max:100'
    );

    protected $common_fields = array('name','client','manager');

    protected $default_sort_field = 'name';

    protected function formRecords($params) {

        $projects = Modules\Project::getObjects($params);

        $records = array();

        foreach ($projects as $num => $project) {

            $records[$num] = $project;
        }

        return $records;
    }

    public function show($id) {

        $data = array();

        $object = Modules\Project::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('watch','projects',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        return view('module-objects.projects.show',compact('data'));
    }


    public function add() {

        abort_if(!auth()->user()->can('create','projects'),403);

        $data = array();

        $data['object'] = new OldRequest();

        $data['clients'] = $this->filterObjects('watch','clients',Modules\Client::getActive());

        $data['employees'] = $this->filterObjects('watch','employees',Modules\Employee::getManagers());

        return view('module-objects.projects.control',compact('data'));
    }

    public function edit($id) {

        $data = array();

        $object = Modules\Project::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('update','projects',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        $data['clients'] = $this->filterObjects('watch','clients',Modules\Client::getActive());

        $data['employees'] = $this->filterObjects('watch','employees',Modules\Employee::getManagers());

        return view('module-objects.projects.control',compact('data'));
    }

    public function create() {

        abort_if(!auth()->user()->can('create','projects'),403);

        $request_data = request()->all();

        $validator =  Validator::make($request_data, $this->validation_arr);

        $errors=$validator->errors();

        if ($errors->all()) {

            return redirect('/projects/add/')->withErrors($validator)->withInput();
        }

        $project = Modules\Project::createObject(request()->all());
        $project->assignNewFlows(explode(';', $request_data['flows_list']));

        Notification::notifyAboutProject('assign-to-project', $project, $project->manager_id);

        return redirect('/projects/show/'.$project->id);
  
    }

    public function update() {

        $project = Modules\Project::find(request('id'));

        abort_if(!auth()->user()->can('update','projects',$project),403);

        $request_data = request()->all();
        
        $validator =  Validator::make($request_data, $this->validation_arr);

        $errors=$validator->errors();

        if ($errors->all()) {

            return redirect('/projects/edit/'.$request_data['id'])->withErrors($validator)->withInput();
        }

        if (($request_data['manager_id'] != $project->manager_id)) {
            Notification::notifyAboutProject('assign-to-project', $project, $request_data['manager_id']);
        }

        $project->updateObject($request_data);
        $project->assignNewFlows(explode(';', request('flows_list')));

        return redirect('/projects/show/'.$project->id);
    }

    public function getFlowsPanel () {

        if (request('id')) {

            abort_if(!auth()->user()->can('update','projects',Modules\Project::find(request('id'))),403);

        } else {

            abort_if(!auth()->user()->can('create','projects'),403);
        }

        $flows_id = explode(';', request('flows_list'));
        $data['flows'] = array();
        $sort_arr = array();

        foreach ($flows_id as $flow_id) {

            if ($flow_id) {

                $flow = Modules\Internal\Flow::find($flow_id);

                if ($flow) { 

                    $data['flows'][] = $flow;

                    $sort_arr[] = $flow->sort_order;
                }
            }
        }

        array_multisort($sort_arr, SORT_ASC, $data['flows']);

        return view('module-objects.projects.flows-stages-control',compact('data'));
    }

}