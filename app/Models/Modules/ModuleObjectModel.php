<?php

namespace App\Models\Modules;

use App;
use App\Models\MainModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ModuleObjectModel extends MainModel
{
    public function isRelatedEmployee($employee_id) {
        return false;
    }

    public function isControlledEmployee($employee_id) {
        return false;
    }

    public static function createObject($data) {

        if (!$data) return;

        $data['enable'] = 1;

        $data = static::convertRequest($data);

        $data = static::filterRequest($data);

        return static::create($data);
    }

    public function disable() {

    	$this->update(['enable' => '0']);
    }

    public static function getObjects($params) {

     	if ($params['sort_by'] && $params['db_sort_possible']) {

    		$sort = $params['sort_by'];
    		$order = ($params['order_by'] == 'desc') ? 'desc' : 'asc';

    		return static::where('enable','1')->orderBy($sort,$order)->get();

    	} else {

    		return static::where('enable','1')->get();
    	}
		
	}

    public static function getActive() {
        return static::where('enable','1')->get();

    }

	public function isActive() {
		return ($this->enable == 0) ? false: true;
	}


}
