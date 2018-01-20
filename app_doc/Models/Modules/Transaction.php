<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;
use App\Special\Tools\UnitsConverter;

/**
* Transactions module model
*
* Модель модуля "Транзакции" 
*
* @author Ilia Terebenin
*/
class Transaction extends ModuleObjectModel
{
    public function isRelatedEmployee($employee_id) {

        if ($this->isControlledEmployee($employee_id)) return true;

        if ($employee_id == $this->employee_id) return true;

        if ($this->project) {
            if ($this->project->isRelatedEmployee($employee_id)) return true;
        }

        if ($this->client) {
            if ($this->client->isRelatedEmployee($employee_id)) return true;
        }

        return false;
    }

    public function isControlledEmployee($employee_id) {
        if ($employee_id == $this->author_id) return true;
        return false;
    }

    public function getType () {

        return Modules\Internal\TransactionType::find($this->type_id);
    }

    public function getProject () {

        return Modules\Project::find($this->project_id);
    }

    public function getClient () {

        return Modules\Client::find($this->client_id);
    }

    public function getEmployee () {

        return Modules\Employee::find($this->employee_id);
    }

    public function getAssignment() {

        $text = '';

        if ($this->project) {
            $text .= trans('strings.fields-name.project') . ': ' . $this->project->name . ', '; 
        }
        if ($this->client) {
            $text .= trans('strings.fields-name.client') . ': ' . $this->client->name . ', '; 
        }
        if ($this->employee) {
            $text .= trans('strings.fields-name.employee') . ': ' . $this->employee . ', '; 
        }

        return substr($text, 0,-2);
        
    }

    public function getKind() {

        return ($this->type->income) ? '+' : '-';
    }

    public function getFormatedSum() {

        return UnitsConverter::formatCurrency($this->sum);
    }

    public function getFormatedDatetimeof() {
        $date = new \DateTime($this->datetimeof);
        return $date->format('H:i  d.m.Y');
    }



    

}
