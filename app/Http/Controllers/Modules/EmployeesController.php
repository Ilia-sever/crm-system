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

class EmployeesController extends ModuleController
{

    protected $model = "\App\Models\Modules\Employee";

    protected $module_code = 'employees';

	protected $validation_arr = array(
            'surname' => 'min:2|max:100|nullable',
            'firstname' => 'min:2|max:100|nullable',
            'lastname' => 'min:2|max:100|nullable',
            'sex' => 'alpha|max:100|nullable',
            'dob' => 'date_format:"Y-m-d"|nullable',
            'role_id' => 'numeric|required|max:100',
            'post' => 'min:3|max:100|nullable',
            'email' => 'email|required',
            'new_password' => 'min:6|max:100|nullable|confirmed',
            'tel' => 'min:5|max:100|nullable',
            'skype' => 'min:3|max:100|nullable'
    );

    protected $common_fields = array('fullname','email','tel','role');

    protected $default_sort_field = 'fullname';

    protected function formRecords($params) {

        $employees = Modules\Employee::getObjects($params);

        $records = array();

        foreach ($employees as $num => $employee) {
            $records[$num] = $employee;
        }

        return $records;
    }

    public function show($id) {

        $data = array();

        $object = Modules\Employee::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('watch','employees',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        return view('module-objects.employees.show',compact('data'));
    }


    public function add() {

        abort_if(!auth()->user()->can('create','employees'),403);

    	$data = array();

        $data['object'] = new OldRequest();

        $data['roles'] = Role::all();

    	return view('module-objects.employees.control',compact('data'));
    }

    public function edit($id) {

        $data = array();

        $object = Modules\Employee::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('update','employees',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        $data['roles'] = Role::all();

        return view('module-objects.employees.control',compact('data'));
    }

    public function create() {

        abort_if(!auth()->user()->can('create','employees'),403);

        $validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();
        
        if (Modules\Employee::isEmailExist(request('email'))) {
            $errors->add('email',trans('strings.messages.email-dublicate'));
        }
        
    	if ($errors->all()) {
            return redirect('/employees/add/')->withErrors($validator)->withInput();
        }

        $new_employee = Modules\Employee::createObject(request()->all());

        return $new_employee ? redirect('/employees?success='.date('U')) : redirect('/employees/add/');
  
    }

    public function update() {
    	
    	$validator =  Validator::make(request()->all(), $this->validation_arr);

    	$errors=$validator->errors();

        if ($errors->all()) {
            return redirect('/employees/edit/'.request('id'))->withErrors($validator)->withInput();
        }

        $employee = Modules\Employee::find(request('id'));

        abort_if(!auth()->user()->can('update','employees',$employee),403);

        $employee->updateObject(request()->all());

        return redirect('/employees?success='.date('U'));
    }
}