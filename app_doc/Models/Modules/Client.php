<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;

/**
* Clients module model
*
* Модель модуля "Клиенты" 
*
* @author Ilia Terebenin
*/
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
        return Modules\Employee::active()->find($this->manager_id);
    }

    public function getProjects() {
    	return Modules\Project::active()->where('client_id',$this->id)->get();
    }

    public function getContacts() {

        $contacts = $this->belongsToMany(Modules\Contact::class, 'agents', 'client_id','contact_id')->where('enable',1);

        return ($contacts->count()) ? $contacts->get() : array();
    }

    public function getTransactions() {
        
        $transactions = Modules\Transaction::active()->where('client_id',$this->id)->orderBy('datetimeof','desc')->limit(config('settings.page-limit'));

        return ($transactions->count()) ? $transactions->get() : array();
    }

}
