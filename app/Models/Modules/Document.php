<?php

namespace App\Models\Modules;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;
use App\Special\Tools\UnitsConverter;

class Document extends ModuleObjectModel
{
    public function isRelatedEmployee($employee_id) {

        if ($this->isControlledEmployee($employee_id)) return true;

        if ($employee_id == $this->employee_id) return true;

        if ($this->project) {
            if ($employee_id == $this->project->manager_id) return true;
        }

        if ($this->client) {
            if ($employee_id == $this->client->manager_id) return true;
        }

        return false;
    }

    public function isControlledEmployee($employee_id) {
        if ($employee_id == $this->author_id) return true;
        return false;
    }

    public function isImage() {

        $image_mime_types = array('image/jpeg','image/png');

        if (in_array($this->mime_type, $image_mime_types)) return true;
    }

    protected function getFile() {

        return new \Illuminate\Http\File($this->file_path);
    }

    public function getFilePath() {

        return storage_path() . DIRECTORY_SEPARATOR . $this->link;
    }

    public function getMimeType() {

        return $this->getFile()->getMimeType();
    }

    public function getAuthor () {

        return Modules\Employee::find($this->author_id);
    }

    public function getFormatedDatetimeof() {
        $date = new \DateTime($this->datetimeof);
        return $date->format('H:i  d.m.Y');
    }

    public function getClientName() {

        $name_parts = explode('.', $this->name);

        array_pop($name_parts);

        return implode('.', $name_parts);
    }

    public function getExtension() {

        $name_parts = explode('.', $this->name);

        return array_pop($name_parts);


    }



    

}
