<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;
use Illuminate\Support\Facades\Hash;

/**
* Contacts module model
*
* Модель модуля "Контакты" 
*
* @author Ilia Terebenin
*/
class Contact extends ModuleObjectModel
{
    use Modules\Traits\HumanTrait;

    public function isRelatedEmployee($employee_id) {
        foreach ($this->companies as $company) {
            if ($company->manager_id == $employee_id) return true;
        }
        return false;
    }

    public function setCompanies($companies_id) {

        Modules\Internal\Agent::where('contact_id',$this->id)->whereNotIn('client_id',$companies_id)->delete();

        foreach ($companies_id as $company_id) {

            if (Modules\Internal\Agent::where('contact_id',$this->id)->where('client_id',$company_id)->count()) continue;
            
            Modules\Internal\Agent::createObject(['contact_id'=>$this->id,'client_id'=>$company_id]);
        }

    }

    public function setSocnetworks($socnetworks) {
        $this->setSocnetworksBy($socnetworks,'contact_id');
    }

    public function getCompanies() {

        $companies = $this->belongsToMany(Modules\Client::class, 'agents', 'contact_id', 'client_id')->where('enable',1);

        return ($companies->count()) ? $companies->get() : array();
    }

    public function getSocnetworks() {
        return $this->getSocnetworksBy('contact_id');
    }
}
