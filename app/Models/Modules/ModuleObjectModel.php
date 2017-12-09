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

    public static function active() {

        return static::where('enable','1');
    }

    public function disable() {

    	$this->update(['enable' => '0']);
    }

    public static function getObjects($params) {

        $objects = static::active();

        if ($params['search_field'] && $params['search_value'] && $params['db_search_possible']) {

            $objects = $objects->where($params['search_field'],'like','%'.$params['search_value'].'%');
        }

     	if ($params['sort_by'] && $params['db_sort_possible']) {

    		$sort = $params['sort_by'];
    		$order = ($params['order_by'] == 'desc') ? 'desc' : 'asc';
    		$objects = $objects->orderBy($sort,$order);
    	}

        return $objects->get(); 
		
	}

    public static function getActive() {
        return static::active()->get();

    }

	public function isActive() {
		return ($this->enable == 0) ? false: true;
	}


}
