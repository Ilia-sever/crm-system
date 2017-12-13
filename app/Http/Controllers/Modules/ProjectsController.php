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

    protected $common_fields = array('name','client','manager');

    protected $default_sort_field = 'name';

    protected function addFormData($data) {

        $data['clients'] = $this->filterObjects('watch','clients',Modules\Client::getActive());

        $data['employees'] = $this->filterObjects('watch','employees',Modules\Employee::getManagers());

        return $data;
    }

    public function create() {

        abort_if(!auth()->user()->can('create','projects'),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/projects/add/')->withErrors($request_data['errors'])->withInput();
        }

        $project = Modules\Project::createObject(request()->all());
        $project->assignNewFlows(explode(';', $request_data['flows_list']));
        $project->attachDocuments($request_data['attachments']);

        Notification::notifyAboutProject('assign-to-project', $project, $project->manager_id);

        return redirect('/projects/show/'.$project->id);
  
    }

    public function update() {

        $project = Modules\Project::find(request('id'));

        abort_if(!auth()->user()->can('update','projects',$project),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/projects/edit/'.$request_data['id'])->withErrors($request_data['errors'])->withInput();
        }

        if (($request_data['manager_id'] != $project->manager_id)) {
            Notification::notifyAboutProject('assign-to-project', $project, $request_data['manager_id']);
        }

        $project->updateObject($request_data);
        $project->assignNewFlows(explode(';', request('flows_list')));
        $project->attachDocuments($request_data['attachments']);

        return redirect('/projects/show/'.$project->id);
    }

    protected function validateRequest($request_data) {

        $errors=Validator::make($request_data,[ 
            'name' => 'min:3|max:100|required',
            'client_id' => 'numeric|nullable|max:100',
            'manager_id' => 'numeric|required|max:100',
        ])->errors();


        if ($request_data['client_id'] && !Modules\Client::find($request_data['client_id'])) {

            $errors->add('manager',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.client')]));
        }


        if ($request_data['manager_id'] && !Modules\Employee::find($request_data['manager_id'])) {

            $errors->add('manager',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.manager')]));
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

    public function getFlowsStagesModal() {

        abort_if(request('id') && !auth()->user()->can('update','projects',Modules\Project::find(request('id'))),403);

        abort_if(!request('id') && !auth()->user()->can('create','projects'),403);

        $data['flows'] = Modules\Internal\Flow::getByList(explode(';', request('flows_list')));

        return view('module-objects.projects.flows-stages-modal',compact('data'));
    }

}