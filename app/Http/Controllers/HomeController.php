<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;
use App\Models\Modules\Internal\Notification;
use App\Models\Role;
use Illuminate\Support\Facades\View;


class HomeController extends Controller
{

    public function index() {

        $new_ntf = auth()->user()->employee()->countNewNotifications();

        $ntf_title = trans('strings.fields-name.notifications');
        if ($new_ntf) {
            $ntf_title .= " (+$new_ntf)";
        }

        $data = array();

        $data['notifications'] = Notification::showForEmployee(auth()->user()->id,config('settings.page-limit'));

        $data = $this->getTasksRecords($data);

        $data = $this->getProjectsRecords($data);

        $data['tabs'] = array();


        $data['tabs'][] = array (
            'name' => $ntf_title,
            'content' => View::make('tab-notifications')->with('data',$data)->render()
        );

        $data['tabs'][] = array (
            'name' => trans('strings.fields-name.my-tasks'),
            'content' => View::make('tab-mytasks')->with('data',$data)->render()
        );

        if ($data['projects-records']) {

            $data['tabs'][] = array (
                'name' => trans('strings.fields-name.my-projects'),
                'content' => View::make('tab-myprojects')->with('data',$data)->render()
            );
        }

        return view('home',compact('data'));

    }

    protected function getTasksRecords ($data) {

        $tasks = Modules\Task::getForExecutor(auth()->user()->id);

        $data['tasks-common-fields'] = array('name','formated_deadline','assignment');

        $data['tasks-records'] = array();

        foreach ($tasks as $num => $task) {

            $data['tasks-records'][$num] = $task;
        }

        $data['tasks-records'] = array_slice($data['tasks-records'], 0, config('settings.page-limit'));

        return $data;
    }

    protected function getProjectsRecords ($data) {

        $projects = Modules\Project::getForManager(auth()->user()->id);

        $data['projects-common-fields'] = array('name','client');

        $data['projects-records'] = array();

        foreach ($projects as $num => $project) {

            $data['projects-records'][$num] = $project;
        }

        $data['projects-records'] = array_slice($data['projects-records'], 0, config('settings.page-limit'));

        return $data;
    }

    public function completingTask() {

        $task = Modules\Task::find(request('task_id'));

        if ($task->executor_id == auth()->user()->id) {

            Notification::notifyAboutTask('complete-task', $task, $task->director_id);

            $task->updateObject(['status'=>'complete']);
        }

        $data = $this->getTasksRecords(array());

        return view('tab-mytasks',compact('data'));

    }
}
