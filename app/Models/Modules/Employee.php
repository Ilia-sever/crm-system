<?php

namespace App\Models\Modules;

use App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modules\Internal\Notification;

class Employee extends ModuleModel
{

    public static function createObject($data) {

        if (!$data) return;

        $data = static::filterRequest($data);

        $data['enable'] = 1;
        $data['password'] = static::formPassword($data['email']);

        return static::create($data);

    }

    protected static function formPassword($value) {

        $hash_options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];

        return password_hash($value, PASSWORD_BCRYPT,$hash_options);

    }

    public static function isEmailExist($email) {
        return (static::where('email',$email)->count()>0) ? true : false;
    }


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
