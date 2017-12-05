<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;
use App\Models\Modules\Internal\Notification;
use App\Models\Role;

class ContactsController extends ModuleController
{

    protected $model = "\App\Models\Modules\Contact";

    protected $module_code = 'contacts';

	protected $validation_arr = array(
            'surname' => 'min:2|max:100|nullable',
            'firstname' => 'min:2|max:100|nullable',
            'lastname' => 'min:2|max:100|nullable',
            'email' => 'email|nullable',
            'tel' => 'min:5|max:100|nullable',
            'skype' => 'min:3|max:100|nullable'
    );

    protected $common_fields = array('fullname','email','tel');

    protected $default_sort_field = 'fullname';

    protected function formRecords($params) {

        $contacts = Modules\Contact::getObjects($params);

        $records = array();

        foreach ($contacts as $num => $contact) {
            $records[$num] = $contact;
        }

        return $records;
    }

    public function show($id) {

        $data = array();

        $object = Modules\Contact::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('watch','contacts',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        return view('module-objects.contacts.show',compact('data'));
    }


    public function add() {

        abort_if(!auth()->user()->can('create','contacts'),403);

    	$data = array();

        $data['object'] = new OldRequest();

        $data['clients'] = $this->filterObjects('watch','clients',Modules\Client::getActive());

    	return view('module-objects.contacts.control',compact('data'));
    }

    public function edit($id) {

        $data = array();

        $object = Modules\Contact::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('update','contacts',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        $data['clients'] = $this->filterObjects('watch','clients',Modules\Client::getActive());

        return view('module-objects.contacts.control',compact('data'));
    }

    public function create() {

        abort_if(!auth()->user()->can('create','contacts'),403);

        $validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();
        
    	if ($errors->all()) {
            return redirect('/contacts/add/')->withErrors($validator)->withInput();
        }

        $request_data = request()->all();

        $contact = Modules\Contact::createObject($request_data);

        foreach ($request_data['companies'] as $num => $company_id) {
            if (!$company_id) unset($request_data['companies'][$num]);
        }

        $contact->setCompanies($request_data['companies']);

        return $contact ? redirect('/contacts/show/'.$contact->id) : redirect('/contacts/add/');
  
    }

    public function update() {

        $contact = Modules\Contact::find(request('id'));

        abort_if(!auth()->user()->can('update','contacts',$contact),403);

        $request_data = $this->protectFields(['role_id','post'],request()->all());
    	
    	$validator =  Validator::make($request_data, $this->validation_arr);

    	$errors=$validator->errors();

        if ($errors->all()) {
            return redirect('/contacts/edit/'.$request_data['id'])->withErrors($validator)->withInput();
        }

        $contact->updateObject($request_data);

        foreach ($request_data['companies'] as $num => $company_id) {
            if (!$company_id) unset($request_data['companies'][$num]);
        }

        $contact->setCompanies($request_data['companies']);

        return redirect('/contacts/show/'.$contact->id);
    }
}