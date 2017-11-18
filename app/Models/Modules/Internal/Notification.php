<?php

namespace App\Models\Modules\Internal;

use App;
use App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Modules\Employee;
use App\Models\Modules\Task;
use App\Models\Modules\Project;

class Notification extends Model
{
    public $timestamps = false;
	protected $guarded = [];

	public function getDatetimeof() {
		$date = new \DateTime($this->datetimeof);
		return $date->format('H:i   d.m.Y');
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

	public static function notifyAboutTask($type, Task $task, $e_id) {

		$notify_data = array();

		$notify_data['title'] = trans("strings.notifications.$type");

		$notify_data['text'] = $task->name . ', ' . 
		trans('strings.fields-name.deadline') . ' ' . $task->formatDeadline() . ', ' .
		trans('strings.fields-name.plaintime') . ' ' . $task->getPlaintime() . ', ' .
		$task->getAssignment();

		$notify_data['link'] = '/tasks/show/' . $task->id;  

		$notify_data['employee_id'] = $e_id;

		static::notify($notify_data);

	}

	public static function notifyAboutProject($type, Project $project, $e_id) {

		$notify_data = array();

		$notify_data['title'] = trans("strings.notifications.$type");

		$notify_data['text'] = $project->name;

		$notify_data['link'] = '/projects/show/' . $project->id;  

		$notify_data['employee_id'] = $e_id;

		static::notify($notify_data);

	}

	

}
