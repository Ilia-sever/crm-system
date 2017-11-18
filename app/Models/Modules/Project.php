<?php

namespace App\Models\Modules;

use App\Models;
use App\Models\Modules\Employee;
use App\Models\Modules\Internal\Flow;
use App\Models\Modules\Internal\Stage;

use Illuminate\Database\Eloquent\Model;

class Project extends ModuleModel
{
	public static function getMy ($id) {
		return static::where('enable','1')->where('manager_id',$id)->orderBy('name')->get();
	}

	public function getClient() {
		if (!$this->client_id) return '';
		if (Employee::where('id',$this->client_id)->count()==0) {
			return '';
		}
		return Employee::find($this->client_id)->getFullname();
	}

	public function getManager() {
		if (!$this->manager_id) return '';
		if (Employee::where('id',$this->manager_id)->count()==0) {
			return '';
		}
		return Employee::find($this->manager_id)->getFullname();
	}

	public function getFlows() {
		return Flow::where('project_id',$this->id)->orderBy('sort_order')->get();
	}

	public function getFlowsList() {
		$flows = Flow::where('project_id',$this->id)->orderBy('sort_order')->get();
		$string_list = '';
		foreach ($flows as $flow) {
			$string_list .= $flow->id . ';';
		}
		return $string_list;
	}
}
