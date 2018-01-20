<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;

/**
* Tasks module model
*
* Модель модуля "Задачи" 
*
* @author Ilia Terebenin
*/
class Task extends ModuleObjectModel
{
    public function isRelatedEmployee($employee_id) {

        if ($this->isControlledEmployee($employee_id)) return true; 

        if ($employee_id == $this->executor_id) return true;
        
        return false;
    }

    public function isControlledEmployee($employee_id) {
        if ($employee_id == $this->director_id) return true;
        return false;
    }

    protected static function convertRequest($data) {

        if (isset($data['plaintime'])) $data['plaintime'] = DateTimeConverter::convertTime($data['plaintime']);
        
        return $data;
    }

    /**
    * Gets tasks by id of it's executor-employee
    *
    * Получает задачи по id их сотрудника-исполнителя
    *
    * @param id $executor_id
    * @return \Illuminate\Database\Eloquent\Collection
    */
    public static function getForExecutor($executor_id) {
        return static::active()->where('executor_id',$executor_id)->where('status','began')->orderBy('deadline')->get();
    }

	/**
    * Adds attachments to task
    *
    * Вносит вложения в задачу
    *
    * @param array $attachments
    * @return void
    */
    public function attachDocuments($attachments) {

        Modules\Internal\Attachment::where('task_id',$this->id)->whereNotIn('document_id',$attachments)->delete();

        foreach ($attachments as $attachment) {

            if (Modules\Internal\Attachment::where('task_id',$this->id)->where('document_id',$attachment)->count()) continue;
            
            Modules\Internal\Attachment::createObject(['task_id'=>$this->id,'document_id'=>$attachment]);
        }
    }

    public function getStage() {
        return Modules\Internal\Stage::find($this->stage_id);
        
    }

    public function getWorkarea() {
        return Modules\Workarea::active()->find($this->workarea_id);
    }

	public function getAssignment() {

        if ($this->stage_id) {

            if (!$this->stage) return;

            if (!$this->stage->project->isActive()) return;

            return $this->stage->project->name . ' - ' . $this->stage->flow->name . ' - ' . $this->stage->name;
        }

		if ($this->workarea_id) {

            if (!$this->workarea) return;

            if (!$this->workarea->isActive()) return;

            return $this->workarea->name;
		}
		
		return '';
	}

	public function getDirector() {
		return Modules\Employee::find($this->director_id);
	}

	public function getExecutor() {
		return Modules\Employee::active()->find($this->executor_id);
	}

    public function getDocuments() {

        $documents = $this->belongsToMany(Modules\Document::class, 'attachments', 'task_id', 'document_id')->where('enable',1);

        return ($documents->count()) ? $documents->get() : array();
    }

    public function getFormatedStatus () {
        return trans('strings.fields-name.statuses.'.$this->status);
    }	

    public function getFormatedPlaintime () {
    	return DateTimeConverter::formatTime($this->plaintime);
    }

    public function getFormatedDeadline() {
    	return DateTimeConverter::formatDate($this->deadline); 
    }

}
