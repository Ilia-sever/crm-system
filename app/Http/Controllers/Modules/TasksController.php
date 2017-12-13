<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

class TasksController extends ModuleController
{
    protected $model = "\App\Models\Modules\Task";

    protected $module_code = 'tasks';

    protected $common_fields = array('name','status','deadline','plaintime','assignment','director','executor');

    protected $default_sort_field = 'status';

    protected function addFormData($data) {

        $data['employees'] = $this->filterObjects('watch','employees',Modules\Employee::getActive());
        $data['projects'] = $this->filterObjects('watch','projects',Modules\Project::getActive());
        $data['workareas'] = $this->filterObjects('watch','workareas',Modules\Workarea::getActive());

        return $data;
    }

    public function create() {

        abort_if(!auth()->user()->can('create','tasks'),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/tasks/add/')->withErrors($request_data['errors'])->withInput();
        }

        $request_data['director_id'] = auth()->user()->id;

        $task = Modules\Task::createObject($request_data);

        $task->attachDocuments($request_data['attachments']);

        if (($task->status == 'began')) {

            Notification::notifyAboutTask('assign-to-task', $task, $task->executor_id);
        }

        return redirect('/tasks/show/'.$task->id);
  
    }

    public function update() {

        $task = Modules\Task::find(request('id'));

        abort_if(!auth()->user()->can('update','tasks',$task),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/tasks/edit/'.$request_data['id'])->withErrors($request_data['errors'])->withInput();
        }

        if (($request_data['executor_id'] != $task->executor_id) && ($request_data['status']=='began')) {
            Notification::notifyAboutTask('assign-to-task', $task, $request_data['executor_id']);
            Notification::notifyAboutTask('remove-from-task', $task, $task->executor_id);
        }

        if (($request_data['status'] != $task->status) && ($request_data['status']=='complete')) {
            Notification::notifyAboutTask('complete-task', $task, $task->director_id);
        }

        if (($request_data['status'] != $task->status) && ($request_data['status']=='began')) {
            Notification::notifyAboutTask('return-to-task', $task, $task->director_id);
        }

        $task->updateObject($request_data);

        $task->attachDocuments($request_data['attachments']);

        return redirect('/tasks/show/'.$task->id);

    }

    protected function validateRequest($request_data) {

        $errors=Validator::make($request_data,[ 
            'name' => 'min:5|max:100|required',
            'status' => 'alpha_dash|min:3|max:100|required',
            'deadline' => 'date_format:"Y-m-d"|nullable',
            'plaintime' => 'max:100|required',
            'workarea_id' => 'numeric|nullable|max:100',
            'stage_id' => 'numeric|nullable|max:100',
            'executor_id' => 'numeric|nullable|max:100',
            'description' => 'min:5|max:10000|nullable'
        ])->errors();

        if ($request_data['workarea_id'] && !Modules\Workarea::find($request_data['workarea_id'])) {

            $errors->add('workarea',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.workarea')]));
        }

        if ($request_data['stage_id'] && !Modules\Internal\Stage::find($request_data['stage_id'])) {

            $errors->add('stage',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.stage')]));
        }

        if ($request_data['executor_id'] && !Modules\Employee::find($request_data['executor_id'])) {

            $errors->add('executor',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.executor')]));
        }

        if (!$request_data['attachments']) {

            $request_data['attachments'] = array();
        }

        foreach ($request_data['attachments'] as $num => $attachment) {

            if (!$attachment || !is_numeric($attachment)) {
                unset($request_data['attachments'][$num]);
            }
        }

        $request_data['errors'] = $errors;

        return $request_data;
    }    

}