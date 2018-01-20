<?php

namespace App\Models;

use App;

use Illuminate\Database\Eloquent\Model;

/**
* Modules objects model
*
* Модель объектов модулей
*
* @author Ilia Terebenin
*/
class Module extends MainModel
{
	/**
	* Returns a list of all app's modules
	*
	* Вовзращает список всех модулей системы
	* @return array
	*/
    public static function getModulesList() {

        $modules = static::all();
        $list = array();

        foreach ($modules as $module) {
            $list[] = $module->name;
        }

        return $list;
    }
}
