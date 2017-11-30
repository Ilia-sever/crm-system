<?php

namespace App\Special;

use App;


class OldRequest
{
    public function __get ($property) {

    	return request()->old($property);
    }
}
