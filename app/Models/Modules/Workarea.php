<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;
use Illuminate\Support\Facades\Hash;

class Workarea extends ModuleObjectModel
{
    public function getCountOfTasks() {
        return Modules\Task::where('enable','1')->where('workarea_id',$this->id)->count();
    }

    public function getTasks() {
        return Modules\Task::where('enable','1')->where('workarea_id',$this->id)->orderBy('name')->get();
    }


}
