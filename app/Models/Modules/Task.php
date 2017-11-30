<?php

namespace App\Models\Modules;

use App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends ModuleObjectModel
{
    public static function formPlaintime ($str) {
        // from '** h ** m' to '**:**:**'
        $hours = (is_numeric(substr($str,0,2))) ? substr($str,0,2) : '';
        $minutes = (is_numeric(substr($str,6,2))) ? substr($str,6,2) : '';
        if (!$hours || !$minutes) return '00:00:00';
        if (intval($minutes) > 59) return '00:00:00';
        return $hours.':'.$minutes.':00';
    }

    public function isRelatedEmployee($employee_id) {
        if ($employee_id == $this->director_id || $employee_id == $this->executor_id) return true;
        return false;
    }

    public function isControlledEmployee($employee_id) {
        if ($employee_id == $this->director_id) return true;
        return false;
    }

    protected static function convertRequest($data) {


        if (!$data['id']) {

            $data['director_id'] = auth()->user()->id;
        }

        if (isset($data['plaintime'])) $data['plaintime'] = static::formPlaintime($data['plaintime']);
        
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
		if (!$this->director_id) return '';
		if (Employee::where('id',$this->director_id)->count()==0) {
			return trans('strings.messages.unknown-employee');
		}
		return Employee::find($this->director_id)->getFullname();
		
	}

	public function getExecutor() {
		if (!$this->executor_id) return '';
		if (Employee::where('id',$this->executor_id)->count()==0) {
			return '';
		}
		return Employee::find($this->executor_id)->getFullname();
	}

    public function getFormatedStatus () {
        return trans('strings.fields-name.statuses.'.$this->status);
    }	

    public function getFormatedPlaintime () {
    	// from '**:**:**' to '** h ** m'
    	$time = static::getTime($this->plaintime);
    	$formated = '';
    	if ($time['hours']!='00') $formated .= intval($time['hours']) . ' ' .trans('strings.units.hours') . ' ';
    	if ($time['minutes']!='00') $formated .= intval($time['minutes']) . ' ' .trans('strings.units.minutes');
    	return $formated;
    }

    public function getFormatedDeadline() {
    	if ($this->deadline) {
    		return static::formatDate($this->deadline); 
    	}
    	return '';

    }

}
