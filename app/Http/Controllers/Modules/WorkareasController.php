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

class WorkareasController extends ModuleController
{

    protected $model = "\App\Models\Modules\Workarea";

    protected $module_code = 'workareas';

	protected $validation_arr = array(
        'name' => 'min:5|max:100|required',
    );

    protected $common_fields = array('name','count_of_tasks');

    protected $default_sort_field = 'name';

    protected function formRecords($params) {

        $workareas = Modules\Workarea::getObjects($params);

        $records = array();

        foreach ($workareas as $num => $workarea) {
            $records[$num] = $workarea;
        }

        return $records;
    }

    public function show($id) {

        $data = array();

        $object = Modules\Workarea::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('watch','workareas',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        return view('module-objects.workareas.show',compact('data'));
    }


    public function add() {

        abort_if(!auth()->user()->can('create','workareas'),403);

    	$data = array();

        $data['object'] = new OldRequest();

    	return view('module-objects.workareas.control',compact('data'));
    }

    public function edit($id) {

        $data = array();

        $object = Modules\Workarea::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('update','workareas',$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        return view('module-objects.workareas.control',compact('data'));
    }

    public function create() {

        abort_if(!auth()->user()->can('create','workareas'),403);

        $validator =  Validator::make(request()->all(), $this->validation_arr);

        $errors=$validator->errors();
        
    	if ($errors->all()) {
            return redirect('/workareas/add/')->withErrors($validator)->withInput();
        }

        $request_data = request()->all();

        $workarea = Modules\Workarea::createObject($request_data);

        return redirect('/workareas/show/'.$workarea->id);
  
    }

    public function update() {

        $workarea = Modules\Workarea::find(request('id'));

        abort_if(!auth()->user()->can('update','workareas',$workarea),403);
    	
    	$validator = Validator::make($request_data, $this->validation_arr);

    	$errors=$validator->errors();

        if ($errors->all()) {
            return redirect('/workareas/edit/'.$request_data['id'])->withErrors($validator)->withInput();
        }

        $workarea->updateObject($request_data);

        return redirect('/workareas/show/'.$workarea->id);
    }
}