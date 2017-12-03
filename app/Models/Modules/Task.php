<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;

class Task extends ModuleObjectModel
{
    public function isRelatedEmployee($employee_id) {
        if ($employee_id == $this->director_id || $employee_id == $this->executor_id) return true;
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

	public static function getForExecutor($executor_id) {
		return static::where('enable','1')->where('executor_id',$executor_id)->where('status','began')->orderBy('deadline')->get();
	}

	public function getAssignment() {
		if ($this->workarea_id) {
			return 'РАБОБЛАСТЬ' . $this->workarea_id;
		}
		if ($this->stage_id) {
			return 'ПРОЕКТ? - ПОТОК? - ЭТАП' . $this->stage_id;
		}
		return '';
	}

	public function getDirector() {
		return Modules\Employee::find($this->director_id);
	}

	public function getExecutor() {
		return Modules\Employee::find($this->executor_id);
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
