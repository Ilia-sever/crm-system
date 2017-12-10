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
        return Modules\Employee::active()->find($this->manager_id);
    }

    public function getProjects() {
    	return Modules\Project::active()->where('client_id',$this->id)->get();
    }

    public function getContacts() {

        $contacts = array();

        $contacts_id =  Modules\Internal\Agent::where('client_id',$this->id)->pluck('contact_id');

        foreach ($contacts_id as $contact_id) {

            $contact = Modules\Contact::active()->find($contact_id);

            if (!$contact) continue;

            $contacts[] = $contact;
        }
        
        return $contacts;
    }

    public function getTransactions() {
        
        return Modules\Transaction::active()->where('client_id',$this->id)->orderBy('datetimeof','desc')->limit(config('settings.page-limit'))->get();
    }

}
