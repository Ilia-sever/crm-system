<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;

class Project extends ModuleObjectModel
{
	public function isRelatedEmployee($employee_id) {
		return ($employee_id == $this->manager_id) ? true : false;
	}

    public function assignNewFlows($flows_id) {

    	foreach ($flows_id as $flow_id) {
            if ($flow_id) {

                $flow = Modules\Internal\Flow::find($flow_id);
                
                if ($flow) { 
                	$flow->update(['project_id' => $this->id]);
                }
            }    
        }
    }

	public static function getForManager($employee_id) {
		return static::active()->where('manager_id',$employee_id)->orderBy('name')->get();
	}

	public function attachDocuments($attachments) {

        Modules\Internal\Attachment::where('project_id',$this->id)->whereNotIn('document_id',$attachments)->delete();

        foreach ($attachments as $attachment) {

            if (Modules\Internal\Attachment::where('project_id',$this->id)->where('document_id',$attachment)->count()) continue;
            
            Modules\Internal\Attachment::createObject(['project_id'=>$this->id,'document_id'=>$attachment]);
        }
    }

	public function __toString() {
		
		return $this->name;
	}

	public function getClient() {
		return Modules\Client::active()->find($this->client_id);
	}

	public function getManager() {
		return Modules\Employee::active()->find($this->manager_id);
	}

	public function getFlows() {
		return Modules\Internal\Flow::where('project_id',$this->id)->orderBy('sort_order')->get();
	}

	public function getFlowsList() {
		
		$string_list = '';
		foreach ($this->flows as $flow) {
			$string_list .= $flow->id . ';';
		}
		return $string_list;
	}

	public function getTransactions() {
		
		$transactions = Modules\Transaction::active()->where('project_id',$this->id)->orderBy('datetimeof','desc')->limit(config('settings.page-limit'));

		return ($transactions->count()) ? $transactions->get() : array();
	}

	public function getDocuments() {

        $documents = $this->belongsToMany(Modules\Document::class, 'attachments', 'project_id', 'document_id')->where('enable',1);

        return ($documents->count()) ? $documents->get() : array();
    }
}
