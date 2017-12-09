<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

class ClientsController extends ModuleController
{
    protected $model = "\App\Models\Modules\Client";

    protected $module_code = 'clients';

    protected $common_fields = array('name','site','manager');

    protected $default_sort_field = 'name';

    protected function addFormData($data) {

        $data['managers'] = $this->filterObjects('watch','employees',Modules\Employee::getManagers());

        return $data;
    }  

    public function create() {

        abort_if(!auth()->user()->can('create','clients'),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/clients/add/')->withErrors($request_data['errors'])->withInput();
        }

        $client = Modules\Client::createObject($request_data);

        if ($client->manager_id) {

            Notification::notifyAboutClient('assign-to-client', $client, $client->manager_id);
        }

        return redirect('/clients/show/'.$client->id);
  
    }

    public function update() {

        $client = Modules\Client::find(request('id'));

        abort_if(!auth()->user()->can('update','clients',$client),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/clients/edit/'.$request_data['id'])->withErrors($request_data['errors'])->withInput();
        }

        if ($request_data['manager_id'] && $request_data['manager_id'] != $client->manager_id) {
            Notification::notifyAboutClient('assign-to-client', $client, $request_data['manager_id']);
        }

        $client->updateObject($request_data);

        return redirect('/clients/show/'.$client->id);

    }

    protected function validateRequest($request_data) {

        $errors=Validator::make($request_data,[ 
            'name' => 'min:5|max:100|required',
            'site' => 'min:5|max:100|nullable',
            'manager_id' => 'numeric|nullable',
        ])->errors();

        if ($request_data['manager_id'] && !Modules\Employee::find($request_data['manager_id'])) {

            $errors->add('manager',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.manager')]));
        }

        $request_data['errors'] = $errors;

        return $request_data;
    }

      

}