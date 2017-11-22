<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\View;

use App\Models\Modules\Project;
use App\Models\Modules\Task;
use App\Models\Modules\Employee;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $me;

    public function index() {

        $this->initializeMe();

        $new_ntf = $this->me->countNewNotifications();

        $ntf_string = trans('strings.fields-name.notifications');
        if ($new_ntf) {
            $ntf_string .= " (+$new_ntf)";
        }

        $data = array();

        $data['notifications'] = $this->me->getNotifications();

        $data = $this->getTasksRecords($data);

        $data = $this->getProjectsRecords($data);

        $data['tabs'] = array();
        $data['tabs'][] = array (
            'name' => $ntf_string,
            'content' => View::make('tab-notifications')->with('data',$data)->render()
        );

        $data['tabs'][] = array (
            'name' => trans('strings.fields-name.my-tasks'),
            'content' => View::make('tab-mytasks')->with('data',$data)->render()
        );

        $data['tabs'][] = array (
            'name' => trans('strings.fields-name.my-projects'),
            'content' => View::make('tab-myprojects')->with('data',$data)->render()
        );

        return view('home',compact('data'));

    }

    public function initializeMe() {

        $this->me = Employee::find(Auth::user()->id);

    }

    protected function getTasksRecords ($data) {

        $tasks = Task::getMy($this->me->id);

        $data['me'] = $this->me;

        $data['tasks-common-fields'] = array('name','deadline','assignment');

        $data['tasks-records'] = array();

        foreach ($tasks as $num => $task) {

            $data['tasks-records'][$num] = array(
                'id' => $task->id,
                'name' => $task->name,
                'deadline' => $task->formatDeadline(),
                'assignment' => $task->getAssignment(),
            );
        }

        return $data;
    }

    public function completingTask() {

        $this->initializeMe();

        $task = Task::find(request('task_id'));

        $task->update(['status'=>'complete']);

        $data = $this->getTasksRecords(array());

        return view('tab-mytasks',compact('data'));

    }

     protected function getProjectsRecords ($data) {

        $projects = Project::getMy($this->me->id);

        $data['projects-common-fields'] = array('name','client');

        $data['projects-records'] = array();

        foreach ($projects as $num => $project) {

            $data['projects-records'][$num] = array(
                'id' => $project->id,
                'name' => $project->name,
                'client' => $project->getClient(),
            );
        }

        return $data;
    }
}
