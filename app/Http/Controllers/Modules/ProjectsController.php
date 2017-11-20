<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use App\Models\Modules\Project;
use App\Models\Modules\Employee;
use App\Models\Modules\Task;
use App\Models\Modules\Internal\Flow;
use App\Models\Modules\Internal\Notification;

use Validator;

class ProjectsController extends ModuleController
{
    protected $module_code = 'projects';

    protected $validation_arr = array(
        'name' => 'min:3|max:100|required',
        'client_id' => 'numeric|nullable|max:100',
        'manager_id' => 'numeric|required|max:100'
    );

    protected $common_fields = array('name','client','manager');

    protected $editable_fields = array('name','client_id','manager_id');

    protected function getRecords ($objects='') {

        $projects = ($objects) ? $objects : Project::getActive();

        $data = array();

        $data['module-code'] = $this->module_code;

        $data['common-fields'] = $this->common_fields;

        $data['records'] = array();

        foreach ($projects as $num => $project) {

            $data['records'][$num] = array(
                'id' => $project->id,
                'name' => $project->name,
                'client' => $project->getClient(),
                'manager' => $project->getManager(),
            );
        }

        return $data;
    }

    public function sort($sort_field,$sort_order) {

        if (Project::isFieldExist($sort_field)) {
            $data = $this->getRecords(Project::getSorted($sort_field,$sort_order));
        } else {
            $data = $this->sortRecords($this->getRecords(),$sort_field,$sort_order);
        }

        return view('module-objects.table-rows',compact('data'));
    }

    public function show($id) {

        $data = array();

        $data['module-code'] = $this->module_code;

        $object = Project::find($id);

        if (!$object) {

            $data['message']='not-found';
            return view('layouts.error',compact('data'));
        }

        if (!$object->isActive()) {

            $data['message']='deleted-object';
            return view('layouts.error',compact('data'));
        }

        $data['object'] = array(
            'id' => $object->id,
            'name' => $object->name,
            'client' => $object->getClient(),
            'manager_id' => $object->manager_id,
            'flows' => $object->getFlows(),
        ) ;

        return view('module-objects.projects.show',compact('data'));
    }


    public function add() {

        $data = array();

        $data['module-code'] = $this->module_code;

        foreach ($this->editable_fields as $field) {
            $data['object'][$field] = (request()->old($field)) ? request()->old($field) : '';
        }

        $data['object']['id'] = '';

        $data['flows'] = request()->old('flows') ? request()->old('flows') : '';

        $data['employees'] = Employee::getActive();

        return view('module-objects.projects.control',compact('data'));
    }

    public function edit($id) {

        $data = array();

        $data['module-code'] = $this->module_code;

        $object = Project::find($id);

        if (!$object) {

            $data['message']='not-found';
            return view('layouts.error',compact('data'));
        }

        if (!$object->isActive()) {

            $data['message']='deleted-object';
            return view('layouts.error',compact('data'));
        }

        foreach ($this->editable_fields as $field) {
            $data['object'][$field] = $object[$field];
        }

        $data['object']['id'] = $object['id'];

        $data['flows'] = $object->getFlowsList();

        $data['employees'] = Employee::getActive();

        return view('module-objects.projects.control',compact('data'));
    }

    public function create() {

        $validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();

        if ($errors->all()) {

            return redirect('/projects/add/')->withErrors($validator)->withInput();
        }

        $newproject = Project::createObject(request()->all());
        $newproject->assignNewFlows(explode(';', request('flows')));

        Notification::notifyAboutProject('assign-to-project', $newproject, $newproject->manager_id);

        return redirect('/projects?success='.date('U'));
  
    }

    public function update() {
        
        $validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();

        if ($errors->all()) {

            return redirect('/projects/edit/'.request('id'))->withErrors($validator)->withInput();
        }
            
        $project = Project::find(request('id'));

        if (!$project) {

            $data['message']='not-found';
            return view('layouts.error',compact('data'));
        }

        if ((request('manager_id') != $project->manager_id)) {
            Notification::notifyAboutProject('assign-to-project', $project, request('manager_id'));
        }

        $project->updateObject(request()->all());
        $project->assignNewFlows(explode(';', request('flows')));

        return redirect('/projects?success='.date('U'));
    }

    public function delete() {
        
        if (request('deleting')) {
            foreach (request('deleting') as $deleting_id) {
                Project::disable();
            }

        }

        $data = $this->getRecords();

        return view('module-objects.table-rows',compact('data'));  
    }

    public function getFlowsPanel () {

        $flows_id = explode(';', request('flows'));
        $data['flows'] = array();
        $sort_arr = array();

        foreach ($flows_id as $flow_id) {

            if ($flow_id) {

                $flow = Flow::find($flow_id);

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