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


    public function can($action_name, $module_name = '', $object = null, $hierarchically = true) {

    	$action = Action::where('name',$action_name)->first();
    	$module = Module::where('name',$module_name)->first() ;

        if (!$module && $module_name) return false;
        $module_id = ($module) ? $module->id : 0;
        
        //finding permission by RBAC hierarchy
        while ($action) {

            if (Permission::isGiven($this->role_id,$action->id,$module_id)) {

                if (!$object) return true;

                //finding additional ckecking for this action if it's object to check

                if (!Permission::isObjectCheckingRequired($action->name)) return true;

                return Permission::checkObject($action->name,$object);

            } else {

            	if (!$hierarchically) break;

                $action = Action::find($action->child_id);
            }

        }

        return false;
    }

}
