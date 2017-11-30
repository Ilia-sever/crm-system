<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Modules\Employee;
use App\Models\Permission;
use App\Models\Module;
use App\Models\Action;


class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;

    protected $table = 'employees';

    public function employee() {
        return Employee::find($this->id);
    }

    public function can($action_name, $module_name = '', $object = null) {

        $module = Module::where('name',$module_name)->first();

        if ($module_name && !$module) return false;

        $module_id = ($module) ? $module->id : 0;

        $action = Action::where('name',$action_name)->first();

        if (!$action) return false;

        //finding permission by RBAC hierarchy

        while ($action) {

            if (Permission::isGiven($this->role_id,$action->id,$module_id)) {

                if (!$object) return true;

                //finding additional ckecking for this action if it's object to check

                $object_checking_method = camel_case('check_' . $action->name);

                if (method_exists(Permission::class, $object_checking_method)) {

                    return Permission::$object_checking_method($object);
                } 

                return true;

            } else {

                $action = Action::find($action->child_id);
            }

        }

        return false;
    }
}
