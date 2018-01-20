<?php

namespace App\Http\Controllers\Modules\Internal;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;

/**
* Projects module's flows controller
*
* Контроллер потоков модуля "Проекты"
*
* @author Ilia Terebenin
*/
class FlowsController extends \App\Http\Controllers\Controller
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
    public function control($project_id,$id) {

        if (!$this->checkAccess(Modules\Project::find($project_id))) return;

        if (!$id) {

            $data['title'] = trans('strings.operations.add-flow');

            $data['object'] = new OldRequest();

        } else {

            $flow = Modules\Internal\Flow::find($id);

            if (!$flow) return;

            $data['title'] = trans('strings.operations.edit-flow');

            $data['object'] = $flow;
        }

        $data['project_id'] = $project_id;

        return view('modules.projects.flows.control',compact('data'));
    }

    /**
    * Processes a request to object's creating/updating
    *
    * Обрабатывает запрос на создание/изменение объекта
    *
    * @return mixed
    */
    public function save() {

        $request_data = request()->all();

        if (!$request_data['project_id']) {
            $request_data['project_id'] = null;
        }

        if (!$this->checkAccess(Modules\Project::find($request_data['project_id']))) return;

        $errors = Validator::make($request_data, [
            'name' => 'min:3|max:100|required',
            'sort_order' => 'integer|min:0|nullable|max:100'
        ])->errors();

        if ($errors->all()) {

            return redirect('/flows/control/'.$request_data['project_id'].'/'.$request_data['id'])->withErrors($errors)->withInput();
        }

        if (!request('id')) {

            $newflow = Modules\Internal\Flow::createObject($request_data);

            return $newflow->id;

        } else {

            $flow = Modules\Internal\Flow::find($request_data['id']);

            if (!$flow) return '';

            $flow->updateObject($request_data);

            return ''; 
        }
        
    }

    /**
    * Processes a request to object's deleting
    *
    * Обрабатывает запрос на удаление объекта
    *
    * @return mixed
    */
    public function delete() {

        $flow = Modules\Internal\Flow::find(request('deleting'));

        if (!$flow) return;

        if (!$this->checkAccess(Modules\Project::find($flow->project_id))) return;

        $flow->deleteStages();
        $flow->delete();
    }

    /**
    * Check access to project-object
    *
    * Проверяет доступ к объекту-проекту
    *
    * @param object $project
    * @return bool
    */
    public function checkAccess($project) {

        if ($project && !auth()->user()->can('update','projects',$project)) return;

        if (!$project && !auth()->user()->can('create','projects')) return;

        return true;
    }

}
