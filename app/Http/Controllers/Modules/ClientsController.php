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

    protected $validation_arr = array(
        'name' => 'min:5|max:100|required',
        'site' => 'min:5|max:100|nullable',
        'manager_id' => 'numeric|nullable|max:100',
    );

    protected $common_fields = array('name','site','manager');

    protected $default_sort_field = 'name';

    protected function formRecords($params) {

        $clients = Modules\Client::getObjects($params);

        $records = array();

        foreach ($clients as $num => $client) {
            $records[$num] = $client;
        }

        return $records;
    }

    public function show($id) {

        $data = array();

        $object = Modules\Client::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('watch','clients',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        return view('module-objects.clients.show',compact('data'));
    }


    public function add() {

        abort_if(!auth()->user()->can('create','clients'),403);

        $data = array();

        $data['object'] = new OldRequest();

        $data['managers'] = $this->filterObjects('watch','employees',Modules\Employee::getManagers());

        return view('module-objects.clients.control',compact('data'));
    }

    public function edit($id) {

        $data = array();

        $object = Modules\Client::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('update','clients',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        $data['managers'] = $this->filterObjects('watch','employees',Modules\Employee::getManagers());

        return view('module-objects.clients.control',compact('data'));
    }

    public function create() {

        abort_if(!auth()->user()->can('create','clients'),403);

        $request_data = request()->all();

        $validator = Validator::make($request_data, $this->validation_arr);

        $errors=$validator->errors();
        
        if ($errors->all()) {

            return redirect('/clients/add/')->withErrors($validator)->withInput();
        }

        $client = Modules\Client::createObject($request_data);

        return redirect('/clients/show/'.$client->id);
  
    }

    public function update() {

        $client = Modules\Client::find(request('id'));

        abort_if(!auth()->user()->can('update','clients',$client),403);

        $request_data = request()->all();
        
        $validator =  Validator::make($request_data, $this->validation_arr);

        $errors=$validator->errors();

        if ($errors->all()) {

            return redirect('/clients/edit/'.$request_data['id'])->withErrors($validator)->withInput();
        }

        $client->updateObject($request_data);

        return redirect('/clients/show/'.$client->id);

    }    

}