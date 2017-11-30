<?php

namespace App\Models\Modules\Internal;

use App;
use App\Models;
use App\Models\MainModel;
use App\Models\Modules\Project;
use App\Models\Modules\Internal\Stage;

use Illuminate\Database\Eloquent\Model;

class Flow extends MainModel
{
	public static function getNew() {
		return static::latest('id')->value('id');
	}

	public function getProject() {
		return Project::find($this->project_id); 
	}

	public function getStages() {
		return Stage::where('flow_id',$this->id)->orderBy('sort_order')->get(); 
	}

	public function deleteStages() {
		Stage::where('flow_id',$this->id)->delete();
	}

}
