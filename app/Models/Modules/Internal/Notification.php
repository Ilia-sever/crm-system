<?php

namespace App\Models\Modules\Internal;

use App;
use App\Models;
use App\Models\MainModel;

use App\Models\Role;
use App\Models\Modules;

class Notification extends MainModel
{

	public static function showForEmployee($employee_id,$limit) {

		if (Notification::where('employee_id',$employee_id)->count() == 0) return array();

    	$nots = Notification::where('employee_id',$employee_id)->orderBy('datetimeof','desc')->take($limit)->get();

    	$last_not = end($nots);
    	$last_not_id = end($last_not)->id;

    	Notification::where('employee_id',$employee_id)->where('viewed',0)->update(['viewed' => 1]);

    	Notification::where('employee_id',$employee_id)->where('id','<',$last_not_id)->delete();

    	return $nots;
    }

	protected static function notify($notify_data) {

		Notification::create([
            'viewed' => 0,
            'datetimeof' => date('Y-m-d H:i:s'),
            'title' => $notify_data['title'],
            'text' => $notify_data['text'],
            'link' => $notify_data['link'],
            'employee_id' => $notify_data['employee_id'] 
        ]);

	}

	public static function notifyAboutTask($type, Modules\Task $task, $employee_id) {

		$notify_data = array();

		$notify_data['title'] = trans("strings.notifications.$type");

		$text = $task->name;

		$text .= ($task->formated_deadline) ? ', ' . trans('strings.fields-name.deadline') . ' ' . $task->formated_deadline : '';

		$text .= ($task->formated_plaintime) ? ', ' . trans('strings.fields-name.plaintime') . ' ' . $task->formated_plaintime : '';

		$text .= ($task->assignment) ? ', ' . $task->assignment : '';

		$notify_data['text'] = $text;

		$notify_data['link'] = '/tasks/show/' . $task->id;  

		$notify_data['employee_id'] = $employee_id;

		static::notify($notify_data);

	}

	public static function notifyAboutProject($type, Modules\Project $project, $employee_id) {

		$notify_data = array();

		$notify_data['title'] = trans("strings.notifications.$type");

		$notify_data['text'] = $project->name;

		$notify_data['link'] = '/projects/show/' . $project->id;  

		$notify_data['employee_id'] = $employee_id;

		static::notify($notify_data);

	}


	public static function notifyAboutClient($type, Modules\Client $client, $employee_id) {

		$notify_data = array();

		$notify_data['title'] = trans("strings.notifications.$type");

		$notify_data['text'] = $client->name;

		if ($client->site) $notify_data['text'] .= ' ('.$client->site.')';

		$notify_data['link'] = '/clients/show/' . $client->id;  

		$notify_data['employee_id'] = $employee_id;

		static::notify($notify_data);
	}

	public static function notifyAboutTransaction(Modules\Transaction $transaction, $employee_id) {

		$notify_data = array();

		$notify_data['title'] = trans("strings.notifications.new-transaction");

		$text = $transaction->type->name;
		$text .= ' ('.$transaction->formated_sum.'). ';
		$text .= $transaction->assignment;

		$notify_data['text'] = $text;

		$notify_data['link'] = '/transactions/show/' . $transaction->id;  

		$notify_data['employee_id'] = $employee_id;

		static::notify($notify_data);
	}


	public function getFormatedDatetimeof() {
		$date = new \DateTime($this->datetimeof);
		return $date->format('H:i  d.m.Y');
	}

}
