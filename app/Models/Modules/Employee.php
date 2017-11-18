<?php

namespace App\Models\Modules;

use App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\Internal\Notification;

class Employee extends ModuleModel
{
	public function getFullname() {
		return $this->surname . ' ' . $this->firstname . ' ' . $this->lastname;
	}

	public function formatDOB() {
    	return static::formatDate($this->dob);
    }

    public function getNotifications() {
    	$nots = Notification::where('employee_id',$this->id)->orderBy('datetimeof','desc')->get();
    	Notification::where('employee_id',$this->id)->update(['viewed' => 1]);
    	return $nots;

    }

    public function countNewNotifications() {
    	return Notification::where('employee_id',$this->id)->where('viewed','0')->count();
    }
}
