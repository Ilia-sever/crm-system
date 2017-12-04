<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;

class Client extends ModuleObjectModel
{
    public function isRelatedEmployee($employee_id) {
        if ($employee_id == $this->manager_id) return true;
        return false;
    }

    public function __toString() {
        return $this->name;
    }

    public function getManager() {
        return Modules\Employee::find($this->manager_id);
    }

    public function getProjects() {
    	return Modules\Project::where('client_id',$this->id)->get();
    }

}
