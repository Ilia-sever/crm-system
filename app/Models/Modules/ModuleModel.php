<?php

namespace App\Models\Modules;

use App;
use App\Models\MainModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;

class ModuleModel extends MainModel
{
	public static function createObject($data) {

        if (!$data) return;

        $data = static::filterRequest($data);

        $data['enable'] = 1;

        return static::create($data);

    }

    public static function disable($id) {

    	$obj = static::find($id);
    	if ($obj) $obj->update(['enable' => '0']);
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
		return ($this->enable=='0') ? false: true;
	}


}
