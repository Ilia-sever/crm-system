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

    public function __toString() {
        return $this->fullname;
    }

    public static function isEmailExist($email) {
        return (static::where('email',$email)->count()>0) ? true : false;
    }

    public function countNewNotifications() {
        return Notification::where('employee_id',$this->id)->where('viewed','0')->count();
    }

    public function getFullname() {

        $fullname = '';
        $fullname .= ($this->surname) ? $this->surname . ' ' : '';
        $fullname .= ($this->firstname) ? $this->firstname . ' ' : '';
        $fullname .= ($this->lastname) ? $this->lastname . ' ' : '';
        return $fullname;
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

}
