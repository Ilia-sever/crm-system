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
* Employees module controller
*
* Контроллер модуля "Сотрудники"
*
* @author Ilia Terebenin
*/
class EmployeesController extends ModuleController
{

    protected $model = "\App\Models\Modules\Employee";

    protected $module_code = 'employees';

    protected $common_fields = array('fullname','email','tel','role');

    protected $default_sort_field = 'fullname';

    protected function addFormData($data) {

        $data['roles'] = Role::all();

        return $data;
    }

    public function create() {

        abort_if(!auth()->user()->can('create','employees'),403);

        $request_data = $this->protectFields(['role_id','post'],request()->all());

        $request_data = $this->validateRequest($request_data);

        if (Modules\Employee::isEmailExist($request_data['email'])) {
            $request_data['errors']->add('email',trans('strings.messages.email-dublicate'));
        }
        
    	if ($request_data['errors']->all()) {
            return redirect('/employees/add/')->withErrors($request_data['errors'])->withInput();
        }

        $employee = Modules\Employee::createObject($request_data);
        $employee->setSocnetworks($request_data['socnetworks']);

        return $employee ? redirect('/employees/show/'.$employee->id) : redirect('/employees/add/');
  
    }

    public function update() {

        $employee = Modules\Employee::find(request('id'));

        abort_if(!auth()->user()->can('update','employees',$employee),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['email'] != $employee->email && Modules\Employee::isEmailExist($request_data['email'])) {
            $request_data['errors']->add('email',trans('strings.messages.email-dublicate'));
        }

        if ($request_data['errors']->all()) {
            return redirect('/employees/edit/'.$request_data['id'])->withErrors($request_data['errors'])->withInput();
        }

        $employee->updateObject($request_data);
        $employee->setSocnetworks($request_data['socnetworks']);

        return redirect('/employees/show/'.$employee->id);
    }

    protected function validateRequest($request_data,$object=null) {

        $errors = Validator::make($request_data,[ 
            'surname' => 'min:2|max:100|nullable',
            'firstname' => 'min:2|max:100|nullable',
            'lastname' => 'min:2|max:100|nullable',
            'sex' => 'alpha|max:100|nullable',
            'dob' => 'date_format:"Y-m-d"|nullable',
            'role_id' => 'numeric',
            'post' => 'min:3|max:100|nullable',
            'email' => 'email|required',
            'new_password' => 'min:6|max:100|nullable|confirmed',
            'tel' => 'min:5|max:100|nullable',
            'skype' => 'min:3|max:100|nullable'
        ])->errors();

        if(!$request_data['surname']&&!$request_data['firstname']&&!$request_data['lastname']) {
            $errors->add('fullname',trans('strings.messages.fullname-empty'));
        }

        if ($request_data['role_id'] && !Role::find($request_data['role_id'])) {

            $errors->add('role',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.role')]));
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