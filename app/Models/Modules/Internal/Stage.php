<?php

namespace App\Models\Modules\Internal;

use App;
use App\Models;
use App\Models\MainModel;
use App\Models\Modules\Internal\Flow;

use Illuminate\Database\Eloquent\Model;

class Stage extends MainModel
{
	public function getFlow() {
		return Flow::find($this->flow_id);
	}

}
