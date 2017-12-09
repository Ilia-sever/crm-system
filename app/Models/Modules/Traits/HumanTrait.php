<?php

namespace App\Models\Modules\Traits;

use Illuminate\Database\Eloquent\Model;

use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

use App\Special\Tools\DateTimeConverter;
use Illuminate\Support\Facades\Hash;

trait HumanTrait
{
    public function setSocnetworksBy($socnetworks,$id_field) {

        $id_arr = array();

        foreach ($socnetworks as $socnetwork) {
            $id_arr[] = $socnetwork['id'];
        }

        Modules\Internal\Socnetwork::where($id_field,$this->id)->whereNotIn('id',$id_arr)->delete();

        foreach ($socnetworks as $socnetwork) {

            if (!$socnetwork['id']) {

                Modules\Internal\Socnetwork::createObject([
                    $id_field => $this->id,
                    'resource' => $socnetwork['resource'],
                    'link' => $socnetwork['link'],
                ]);
                
            } else {

                $soc_network = Modules\Internal\Socnetwork::find($socnetwork['id']);

                if (!$soc_network) continue;

                $soc_network->updateObject($socnetwork);

            }
        }
    }

    public function __toString() {
        return $this->fullname;
    }

    public function getFullname() {

        $fullname = '';
        $fullname .= ($this->surname) ? $this->surname . ' ' : '';
        $fullname .= ($this->firstname) ? $this->firstname . ' ' : '';
        $fullname .= ($this->lastname) ? $this->lastname . ' ' : '';
        return $fullname;
    }

    public function getSocnetworksBy($id_field) {

        return Modules\Internal\Socnetwork::where($id_field,$this->id)->get();
    }
}
