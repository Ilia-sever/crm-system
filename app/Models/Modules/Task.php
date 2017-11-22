<?php

namespace App\Models\Modules;

use App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

class Task extends ModuleModel
{

	public static function createObject($data) {

        if (!$data) return;

        $data = static::filterRequest($data);

        $data['enable'] = 1;
        $data['director_id'] = Auth::user()->id;
        $data['plaintime'] = static::formPlaintime($data['plaintime']);

        return static::create($data);

    }

    public function updateObject($data) {

    	if (!$data) return;

    	$data = static::filterRequest($data);

    	$data['plaintime'] = static::formPlaintime($data['plaintime']);

    	$this->update($data);

    }


	public static function getMy ($executor_id) {
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

	public static function formPlaintime ($str) {
        // from '** h ** m' to '**:**:**'
        $hours = (is_numeric(substr($str,0,2))) ? substr($str,0,2) : '';
        $minutes = (is_numeric(substr($str,6,2))) ? substr($str,6,2) : '';
        if (!$hours || !$minutes) return '00:00:00';
        if (intval($minutes) > 59) return '00:00:00';
        return $hours.':'.$minutes.':00';
    }

    public function getPlaintime () {
    	// from '**:**:**' to '** h ** m'
    	$time = static::getTime($this->plaintime);
    	$formated = '';
    	if ($time['hours']!='00') $formated .= intval($time['hours']) . ' ' .trans('strings.units.hours') . ' ';
    	if ($time['minutes']!='00') $formated .= intval($time['minutes']) . ' ' .trans('strings.units.minutes');
    	return $formated;
    }

    public function formatDeadline() {
    	if ($this->deadline) {
    		return static::formatDate($this->deadline); 
    	}
    	return '';

    }



}
