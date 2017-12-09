<?php

namespace App\Models\Modules\Internal;

use Illuminate\Database\Eloquent\Model;

use App;
use App\Models\MainModel;
use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

class Flow extends MainModel
{
	public static function getByList($id_list) {

		return static::whereIn('id',$id_list)->orderBy('sort_order')->get();
	}

	public function getProject() {

		return Modules\Project::find($this->project_id); 
	}

	public function getStages() {
		
		return Modules\Internal\Stage::where('flow_id',$this->id)->orderBy('sort_order')->get(); 
	}

	public function deleteStages() {
		foreach ($this->stages as $stage) {
			$stage->unassignTasks();
			$stage->delete();
		}
	}
}
