<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;
use Illuminate\Support\Facades\Hash;

class Employee extends ModuleObjectModel
{
    use Modules\Traits\HumanTrait;

    public function isRelatedEmployee($employee_id) {
        return ($employee_id == $this->id) ? true : false;
    }

    protected static function convertRequest($data) {

        if (isset($data['new_password'])) {

            if ($data['new_password']) {

                $data['password'] = Hash::make($data['new_password']);
            }
        }

        return $data;
    }

    public function setSocnetworks($socnetworks) {
        $this->setSocnetworksBy($socnetworks,'employee_id');
    }

    protected static function getManagers() {

        $available_roles = array('director','manager');
        $available_roles_id = array();

        foreach(Role::whereIn('name',$available_roles)->pluck('id') as $role_id) {
            $available_roles_id[] = $role_id;
        }

        return static::active()->whereIn('role_id',$available_roles_id)->get();
    }    

    public static function isEmailExist($email) {
        return (static::where('email',$email)->count()>0) ? true : false;
    }

    public function countNewNotifications() {
        return Notification::where('employee_id',$this->id)->where('viewed','0')->count();
    }

    public function getFormatedDob() {
        return DateTimeConverter::formatDate($this->dob);
    }

    public function getSexName() {
        return ($this->sex) ? trans('strings.fields-name.sexes.'.$this->sex) : ''; 
    }

    public function getRole() {
        return Role::find($this->role_id);;
    }

    public function getSocnetworks() {
        return $this->getSocnetworksBy('employee_id');
    }

}
