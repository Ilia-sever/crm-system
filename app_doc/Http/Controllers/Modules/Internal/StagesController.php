<?php

namespace App\Http\Controllers\Modules\Internal;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;

/**
* Projects module's stages controller
*
* Контроллер этапов модуля "Проекты"
*
* @author Ilia Terebenin
*/
class StagesController extends \App\Http\Controllers\Controller
{
    /**
    * Form modal window for object's adding/editing
    *
    * Формирует модальное окно создания/редактирования объекта
    *
    * @param string $project_id
    * @param string $id
    * @return mixed
    */
    public function control($flow_id,$id) {

        $stage = ($id) ? Modules\Internal\Stage::find($id) : null;

        if (!$flow_id) $flow_id = $stage->flow->id;

        $flow = Modules\Internal\Flow::find($flow_id);

        if (!$this->checkAccess($flow)) return;

    	if (!$id) {

            $data['title'] = trans('strings.operations.add-stage').' ('.$flow->name.') ';

            $data['object'] = new OldRequest();

    	} else {

            if (!$stage) return;

            $data['title'] = trans('strings.operations.edit-stage').' ('.$flow->name.') ';

    		$data['object'] = $stage;
    	}

        $data['flow_id'] = $flow_id;

    	return view('modules.projects.stages.control',compact('data'));
    }

    /**
    * Processes a request to object's creating/updating
    *
    * Обрабатывает запрос на создание/изменение объекта
    *
    * @return mixed
    */
    public function save() {

        if (!$this->checkAccess(Modules\Internal\Flow::find(request('flow_id')))) return;

    	$errors =  Validator::make(request()->all(), [
            'name' => 'min:3|max:100|required',
            'status' => 'min:3|max:100|required',
            'sort_order' => 'integer|min:0|nullable|max:100'
        ])->errors();

        if ($errors->all()) {

            return redirect('/stages/control/'.request('flow_id').'/'.request('id'))->withErrors($errors)->withInput();
        }

        if (!request('id')) {

            Modules\Internal\Stage::createObject(request()->all());

        } else {

            $stage = Modules\Internal\Stage::find(request('id'));

            if (!$stage) return;
        	
            $stage->updateObject(request()->all());	
        }

        return '';
    }

    /**
    * Processes a request to object's deleting
    *
    * Обрабатывает запрос на удаление объекта
    *
    * @return mixed
    */
    public function delete() {

    	$stage = Modules\Internal\Stage::find(request('deleting'));

        if (!$this->checkAccess(Modules\Internal\Flow::find($stage->flow_id))) return;

        $stage->unassignTasks();
        $stage->delete();
    }

    /**
    * Check access to project-object
    *
    * Проверяет доступ к объекту-проекту
    *
    * @param object $project
    * @return bool
    */
    public function checkAccess($flow) {

        if (!$flow) return false;

        if ($flow->project && !auth()->user()->can('update','projects',Modules\Project::find($flow->project->id))) return false;

        if (!$flow->project && !auth()->user()->can('create','projects')) return false;

        return true;
    }

}
