<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules\Project;
use App\Models\Modules\Task;
use App\Models\Modules\Employee;

use App\Models\Modules\Internal\Notification;

class TasksController extends ModuleController
{
    protected $model = "\App\Models\Modules\Task";

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

    protected $common_fields = array('name','formated_status','formated_deadline','formated_plaintime','assignment','director','executor');

    protected $default_sort_field = 'formated_status';


    protected function formRecords($params) {

        $tasks = Task::getObjects($params);

        $records = array();

        foreach ($tasks as $num => $task) {
            $records[$num] = $task;
        }

        return $records;
    }

    public function show($id) {

        $data = array();

        $object = Task::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('watch','tasks',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        return view('module-objects.tasks.show',compact('data'));
    }


    public function add() {

        abort_if(!auth()->user()->can('create','tasks'),403);

        $data = array();

        $data['object'] = new OldRequest();

        $data['employees'] = Employee::getActive();

        return view('module-objects.tasks.control',compact('data'));
    }

    public function edit($id) {

        $data = array();

        $object = Task::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('update','tasks',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        $data['employees'] = Employee::getActive();

        return view('module-objects.tasks.control',compact('data'));
    }

    public function create() {

        abort_if(!auth()->user()->can('create','tasks'),403);

        $validator = Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();
        
        if ($errors->all()) {

            return redirect('/tasks/add/')->withErrors($validator)->withInput();
        }

        $newtask = Task::createObject(request()->all());

        if (($newtask->status == 'began')) {

            Notification::notifyAboutTask('assign-to-task', $newtask, $newtask->executor_id);

        }

        return redirect('/tasks?success='.date('U'));
  
    }

    public function update() {
        
        $validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();

        if ($errors->all()) {

        return redirect('/tasks/edit/'.request('id'))->withErrors($validator)->withInput();
  
        }
        
        $task = Task::find(request('id'));

        abort_if(!auth()->user()->can('update','tasks',$task),403);

        if ((request('executor_id') != $task->executor_id) && (request('status')=='began')) {
            Notification::notifyAboutTask('assign-to-task', $task, request('executor_id'));
            Notification::notifyAboutTask('remove-from-task', $task, $task->executor_id);
        }

        if ((request('status') != $task->status) && (request('status')=='complete')) {
            Notification::notifyAboutTask('complete-task', $task, $task->director_id);
        }

        $task->updateObject(request()->all());

        return redirect('/tasks?success='.date('U'));

    }    

}