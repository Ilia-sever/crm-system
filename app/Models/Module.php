<?php

namespace App\Models;

use App;

use Illuminate\Database\Eloquent\Model;

class Module extends MainModel
{
    public static function getModulesList() {

        $modules = static::all();
        $list = array();

        foreach ($modules as $module) {
            $list[] = $module->name;
        }

        return $list;
    }
}
