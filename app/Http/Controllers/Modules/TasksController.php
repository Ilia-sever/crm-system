<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use App\Models\Modules\Employee;
use App\Models\Modules\Task;
use App\Models\Modules\Internal\Notification;

use Validator;
use Illuminate\Support\Facades\Input;

class TasksController extends ModuleController
{
    protected $module_code = 'tasks';

    protected $validation_arr = array(
        'name' => 'min:5|max:100|required',
        'status' => 'alpha_dash|min:3|max:100|required',
        'deadline' => 'date_format:"Y-m-d"|nullable',
        'plaintime' => 'max:100|required',
        'workarea_id' => 'numeric|nullable|max:100',
        'stage_id' => 'numeric|nullable|max:100',
        'executor_id' => 'numeric|nullable|max:100',
        'description' => 'min:5|max:10000|nullable'
    );

    protected $common_fields = array('name','status','deadline','plaintime','assignment','director','executor');

    protected $editable_fields = array('name','status','deadline','plaintime','workarea_id','stage_id','executor_id','description');

    protected function getRecords ($objects='') {

        $tasks = ($objects) ? $objects : Task::getActive();

        $data = array();

        $data['module-code'] = $this->module_code;

        $data['common-fields'] = $this->common_fields;

        $data['records'] = array();

        foreach ($tasks as $num => $task) {

            $data['records'][$num] = array(
                'id' => $task->id,
                'name' => $task->name,
                'status' => trans('strings.fields-name.statuses.'.$task->status),
                'deadline' => $task->formatDeadline(),
                'plaintime' => $task->getPlaintime(),
                'assignment' => $task->getAssignment(),
                'director' => $task->getDirector(),
                'executor' => $task->getExecutor(),
            );
        }

        return $data;
    }

    public function sort($sort_field,$sort_order) {

        if (Task::isFieldExist($sort_field)) {
            $data = $this->getRecords(Task::getSorted($sort_field,$sort_order));
        } else {
            $data = $this->sortRecords($this->getRecords(),$sort_field,$sort_order);
        }

        return view('module-objects.table-rows',compact('data'));
    }

    public function show($id) {

        $data = array();

        $data['module-code'] = $this->module_code;

        $object = Task::find($id);

        if (!$object->isActive()) {

            $data['message']='deleted-object';
            return view('layouts.error',compact('data'));
        }

        $data['object'] = array(
            'id' => $object->id,
            'name' => $object->name,
            'status' =>  trans('strings.fields-name.statuses.'.$object->status),
            'deadline' => $object->formatDeadline(),
            'plaintime' => $object->getPlaintime(),
            'assignment' => $object->getAssignment(),
            'director' => $object->getDirector(),
            'executor' => $object->getExecutor(),
            'description' => $object->description,
        ) ;

        return view('module-objects.tasks.show',compact('data'));
    }


    public function add() {

        $data = array();

        $data['module-code'] = $this->module_code;

        foreach ($this->editable_fields as $field) {
            $data['object'][$field] = (request()->old($field)) ? request()->old($field) : '';
        }

        $data['object']['id'] = '';

        $data['employees'] = Employee::getActive();

        return view('module-objects.tasks.control',compact('data'));
    }

    public function edit($id) {

        $data = array();

        $data['module-code'] = $this->module_code;

        $object = Task::find($id);

        if (!$object->isActive()) {

            $data['message']='deleted-object';
            return view('layouts.error',compact('data'));
        }

        foreach ($this->editable_fields as $field) {
            $data['object'][$field] = $object[$field];
        }

        $data['object']['id'] = $object['id'];

        $data['employees'] = Employee::getActive();

        return view('module-objects.tasks.control',compact('data'));
    }

    public function create() {

        $validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();

        $plaintime = Task::formPlaintime(request('plaintime'));

        if (!$plaintime) {
            $errors->add('plaintime',trans('strings.messages.plaintime-fail'));
        }
        
        if (!$errors->all()) {

            Task::create([
                'enable' => '1',
                'name' => request('name'),
                'status' => request('status'),
                'deadline' => request('deadline'),
                'plaintime' => $plaintime,
                'workarea_id' => request('workarea_id'),
                'stage_id' => request('stage_id'),
                'director_id' => '10',
                'executor_id' => request('executor_id'),
                'description' => request('description')

            ] );

            $newtask = Task::find(Task::getNew());

            if (($newtask->status == 'began')) {

                Notification::notifyAboutTask('assign-to-task', $newtask, $newtask->executor_id);
            }

            return redirect('/tasks?success='.date('U'));

        } else {

            return redirect('/tasks/add/')->withErrors($validator)->withInput();
        }
  
    }

    public function update() {
        
        $validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();

        if (!Task::isExist(request('id'))) {

            $data['message']='not-found';

            return view('layouts.error',compact('data'));
        }

        $plaintime = Task::formPlaintime(request('plaintime'));

        if (!$plaintime) {
            $errors->add('plaintime',$plaintime);
        }

        if (!$errors->all()) {

            $task = Task::find(request('id'));

            if ((request('executor_id') != $task->executor_id) && (request('status')=='began')) {
                Notification::notifyAboutTask('assign-to-task', $task, request('executor_id'));
                Notification::notifyAboutTask('remove-from-task', $task, $task->executor_id);
            }

            if ((request('status') != $task->status) && (request('status')=='complete')) {
                Notification::notifyAboutTask('complete-task', $task, $task->director_id);

            }

            $task->update([
                'name' => request('name'),
                'status' => request('status'),
                'deadline' => request('deadline'),
                'plaintime' => $plaintime,
                'workarea_id' => request('workarea_id'),
                'stage_id' => request('stage_id'),
                'executor_id' => request('executor_id'),
                'description' => request('description')

            ] );

            return redirect('/tasks?success='.date('U'));

        } else {

        return redirect('/tasks/edit/'.request('id'))->withErrors($validator)->withInput();
  
        }
    }

    public function delete() {
        
        if (request('deleting')) {
            foreach (request('deleting') as $deleting_id) {
                Task::find($deleting_id)->update(['enable' => '0']);
            }
        }

        $data = $this->getRecords();

        return view('module-objects.table-rows',compact('data'));  
    }

    

}