<?php

namespace App\Models\Modules;

use App;
use App\Models\MainModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

/**
* Superclass for module models
*
* Суперкласс для моделей модулей
*
* @author Ilia Terebenin
*/
class ModuleObjectModel extends MainModel
{

    /**
    * Checks if the object is associated with the user according to his id
    *
    * Проверяет, связан ли объект с пользователем согласно его id
    *
    * @return bool
    */
    public function isRelatedEmployee($employee_id) {
        return false;
    }

    /**
    * Checks if the object belongs to the user according to his id
    *
    * Проверяет, принадлежит ли объект пользователю согласно его id
    *
    * @return bool
    */
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

    /**
    * Checks if the object is enable
    *
    * Проверяет, активен ли объект
    *
    * @return bool
    */
    public static function active() {

        return static::where('enable','1');
    }

    /**
    * Disables the object
    *
    * Деактивирует объект
    *
    * @return void
    */
    public function disable() {

    	$this->update(['enable' => '0']);
    }

    /**
    * Gets objects by the parameters
    *
    * Получает объекты согласно параметрам
    *
    * @param array $params
    * @return \Illuminate\Database\Eloquent\Collection
    */
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
    
    /**
    * Gets the enable objects
    *
    * Получает все активные объекты
    *
    * @return \Illuminate\Database\Eloquent\Collection
    */
    public static function getActive() {
        return static::active()->get();

    }

    /**
    * Checks if the object's is enable
    *
    * Проверяет, активен ли объект
    *
    * @return bool
    */
	public function isActive() {
		return ($this->enable == 0) ? false: true;
	}


}
