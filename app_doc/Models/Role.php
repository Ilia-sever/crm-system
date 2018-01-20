<?php

namespace App\Models;

use App;

use Illuminate\Database\Eloquent\Model;

/**
* Roles objects model
*
* Модель объектов ролей пользователей
*
* @author Ilia Terebenin
*/
class Role extends MainModel
{
    public function __toString() {
    	return trans('strings.roles.'.$this->name);
    }
}
