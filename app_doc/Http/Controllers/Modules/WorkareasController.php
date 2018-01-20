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
* Workareas module controller
*
* Контроллер модуля "Рабочие области"
*
* @author Ilia Terebenin
*/
class WorkareasController extends ModuleController
{

    protected $model = "\App\Models\Modules\Workarea";

    protected $module_code = 'workareas';

    protected $common_fields = array('name','count_of_tasks');

    protected $default_sort_field = 'name';

    public function create() {

        abort_if(!auth()->user()->can('create','workareas'),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/workareas/add/')->withErrors($request_data['errors'])->withInput();
        }

        $workarea = Modules\Workarea::createObject($request_data);

        return redirect('/workareas/show/'.$workarea->id);
  
    }

    public function update() {

        $workarea = Modules\Workarea::find(request('id'));

        abort_if(!auth()->user()->can('update','workareas',$workarea),403);
    	
    	$request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/workareas/edit/'.$request_data['id'])->withErrors($request_data['errors'])->withInput();
        }

        $workarea->updateObject($request_data);

        return redirect('/workareas/show/'.$workarea->id);
    }

    protected function validateRequest($request_data) {

        $errors=Validator::make($request_data,[ 
            'name' => 'min:3|max:100|required',
        ])->errors();

        $request_data['errors'] = $errors;

        return $request_data;
    }
}