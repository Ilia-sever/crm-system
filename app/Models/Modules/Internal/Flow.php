<?php

namespace App\Models\Modules\Internal;

use App;
use App\Models;
use App\Models\Modules\Internal\Stage;

use Illuminate\Database\Eloquent\Model;

class Flow extends Model
{
    public $timestamps = false;
	protected $guarded = [];

	public static function getNew() {
		return static::latest('id')->value('id');
	}

	public function getStages() {
		return Stage::where('flow_id',$this->id)->orderBy('sort_order')->get(); 
	}

}
