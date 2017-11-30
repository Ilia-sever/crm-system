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

    	$nots = Notification::where('employee_id',$employee_id)->orderBy('datetimeof','desc')->limit($limit)->get();

    	Notification::where('employee_id',$employee_id)->where('viewed',0)->update(['viewed' => 1]);

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

	public function getFormatedDatetimeof() {
		$date = new \DateTime($this->datetimeof);
		return $date->format('H:i  d.m.Y');
	}

}
