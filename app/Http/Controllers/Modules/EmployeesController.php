<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;

use App\Models\Modules\Employee;
use App\Models\Modules\Task;

use Validator;

class EmployeesController extends ModuleController
{
	protected $module_code = 'employees';

	protected $validation_arr = array(
            'surname' => 'alpha_dash|min:2|max:100|nullable',
            'firstname' => 'alpha_dash|min:2|max:100|nullable',
            'lastname' => 'alpha_dash|min:2|max:100|nullable',
            'sex' => 'alpha|max:100|nullable',
            'dob' => 'date_format:"Y-m-d"|nullable',
            'role_id' => 'numeric|required|max:100',
            'post' => 'alpha|min:3|max:100|nullable',
            'email' => 'email|required',
            'tel' => 'min:5|max:100|nullable',
            'skype' => 'min:3|max:100|nullable'
    );

    protected $common_fields = array('fullname','email','tel','role');

	protected $editable_fields = array('surname','firstname','lastname','sex','dob','role_id','post','email','tel','skype');

    protected function getRecords ($objects='') {

        $employees = ($objects) ? $objects : Employee::getActive();

        $data = array();

        $data['module-code'] = $this->module_code;

        $data['common-fields'] = $this->common_fields;

        $data['records'] = array();

        foreach ($employees as $num => $employee) {
            $data['records'][$num] = array(
                'id' => $employee->id,
                'fullname' => $employee->getFullname(), 
                'email' => $employee->email,
                'tel' => $employee->tel,
                'role' => $employee->role_id
            );
        }

        return $data;
    }

    public function sort($sort_field,$sort_order) {

        if (Employee::isFieldExist($sort_field)) {
            $data = $this->getRecords(Employee::getSorted($sort_field,$sort_order));
        } else {
            $data = $this->sortRecords($this->getRecords(),$sort_field,$sort_order);
        }

        return view('module-objects.table-rows',compact('data'));
    }

    public function show($id) {

        $data = array();

        $data ['module-code'] = $this->module_code;

        $object = Employee::find($id);

        if (!$object) {

            $data['message']='not-found';
            return view('layouts.error',compact('data'));
        }

        if (!$object->isActive()) {

            $data['message']='deleted-object';
            return view('layouts.error',compact('data'));
        }

        $data['object'] = array(
            'id' => $object->id,
            'fullname' => $object->getFullname(), 
            'sex' => trans('strings.fields-name.sexes.'.$object->sex),
            'dob' => $object->formatDOB(),
            'role' => $object->role_id,
            'post' => $object->post,
            'email' => $object->email,
            'tel' => $object->tel,
            'skype' => $object->skype
        ) ;

        return view('module-objects.employees.show',compact('data'));
    }


    public function add() {

    	$data = array();

    	$data['module-code'] = $this->module_code;

        foreach ($this->editable_fields as $field) {
            $data['object'][$field] = (request()->old($field)) ? request()->old($field) : '';
        }

        $data['object']['id'] = '';

    	return view('module-objects.employees.control',compact('data'));
    }

    public function edit($id) {

        $data = array();

        $data['module-code'] = $this->module_code;

        $object = Employee::find($id);

        if (!$object) {

            $data['message']='not-found';
            return view('layouts.error',compact('data'));
        }

        if (!$object->isActive()) {

            $data['message']='deleted-object';
            return view('layouts.error',compact('data'));
        }

        foreach ($this->editable_fields as $field) {
            $data['object'][$field] = $object[$field];
        }

        $data['object']['id'] = $object['id'];

        return view('module-objects.employees.control',compact('data'));
    }

    public function create() {

        $validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();
        
        if (Employee::isEmailExist(request('email'))) {
            $errors->add('email',trans('strings.messages.email-dublicate'));
        }
        
    	if ($errors->all()) {
            return redirect('/employees/add/')->withErrors($validator)->withInput();
        }

        $new_employee = Employee::createObject(request()->all());

        return $new_employee ? redirect('/employees?success='.date('U')) : redirect('/employees/add/');
  
    }

    public function update() {
    	
    	$validator =  Validator::make(request()->all(), $this->validation_arr);

    	$errors=$validator->errors();

        if ($errors->all()) {
            return redirect('/employees/edit/'.request('id'))->withErrors($validator)->withInput();
        }

        $employee = Employee::find(request('id'));

        if (!$employee) {

            $data['message']='not-found';
            return view('layouts.error',compact('data'));
        }

        $employee->updateObject(request()->all());

        return redirect('/employees?success='.date('U'));

    }

    public function delete() {
        
        if (request('deleting')) {
            foreach (request('deleting') as $deleting_id) {
                Employee::disable($deleting_id);
            }
        }

        $data = $this->getRecords();

        return view('module-objects.table-rows',compact('data'));  
    }
}