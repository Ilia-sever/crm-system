<?php

namespace App\Models;

use App;

use Illuminate\Database\Eloquent\Model;

class Role extends MainModel
{
    public function __toString() {
    	return trans('strings.roles.'.$this->name);
    }
}
