<?php

namespace App\Models\Modules\Internal;

use Illuminate\Database\Eloquent\Model;

use App;
use App\Models\MainModel;
use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

class Stage extends MainModel
{
	public function getFlow() {
		return Modules\Internal\Flow::find($this->flow_id);
	}

	public function getProject() {
		return Modules\Project::find($this->flow->project_id);
	}

	public function getTasks() {
		if (!Modules\Task::where('stage_id',$this->id)->count()) return;
			
		return Modules\Task::where('stage_id',$this->id)->get();
	}

	public function unassignTasks() {

		Modules\Task::where('stage_id',$this->id)->update(['stage_id'=>null]);
	}

}
