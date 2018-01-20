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

/**
* Contacts module controller
*
* Контроллер модуля "Контакты" 
*
* @author Ilia Terebenin
*/
class ContactsController extends ModuleController
{

    protected $model = "\App\Models\Modules\Contact";

    protected $module_code = 'contacts'; 

    protected $common_fields = array('fullname','email','tel');

    protected $default_sort_field = 'fullname';

    protected function addFormData($data) {

        $data['clients'] = $this->filterObjects('watch','clients',Modules\Client::getActive());

        return $data;
    }

    public function create() {

        abort_if(!auth()->user()->can('create','contacts'),403);    	

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/contacts/add/')->withErrors($request_data['errors'])->withInput();
        }

        $contact = Modules\Contact::createObject($request_data);
        $contact->setCompanies($request_data['companies']);
        $contact->setSocnetworks($request_data['socnetworks']);

        return $contact ? redirect('/contacts/show/'.$contact->id) : redirect('/contacts/add/');
  
    }

    public function update() {

        $contact = Modules\Contact::find(request('id'));

        abort_if(!auth()->user()->can('update','contacts',$contact),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/contacts/edit/'.$request_data['id'])->withErrors($request_data['errors'])->withInput();
        }

        $contact->updateObject($request_data);
        $contact->setCompanies($request_data['companies']);
        $contact->setSocnetworks($request_data['socnetworks']);

        return redirect('/contacts/show/'.$contact->id);
    }

    protected function validateRequest($request_data) {

        $errors=Validator::make($request_data,[ 
            'surname' => 'min:2|max:100|nullable',
            'firstname' => 'min:2|max:100|nullable',
            'lastname' => 'min:2|max:100|nullable',
            'email' => 'email|nullable',
            'tel' => 'min:5|max:100|nullable',
            'skype' => 'min:3|max:100|nullable'
        ])->errors();

        if(!$request_data['surname']&&!$request_data['firstname']&&!$request_data['lastname']) {
            $errors->add('fullname',trans('strings.messages.fullname-empty'));
        }

        foreach ($request_data['companies'] as $num => $company_id) {
            if (!$company_id || !is_numeric($company_id)) unset($request_data['companies'][$num]);
        }

        $request_data['socnetworks'] = array();

        foreach ($request_data['socnetwork_links'] as $num => $socnetwork_link) {

            if (!$socnetwork_link) continue;

            $socnetwork_data = [
                'id'=>$request_data['socnetwork_ids'][$num],
                'resource'=>$request_data['socnetwork_resources'][$num],
                'link'=>$socnetwork_link
            ];

            $socnetwork_data_errors = Validator::make($socnetwork_data, [
                'resource'=>'max:100|nullable',
                'link'=>'max:256|required',
            ])->errors();

            if ($socnetwork_data_errors->all()) {
                $errors->merge($socnetwork_data_errors);
                break;
            }
            
            $request_data['socnetworks'][] = $socnetwork_data;
        }

        $request_data['errors'] = $errors;

        return $request_data;
    }
}