<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers;
use Illuminate\Http\Request;

class ModuleController extends \App\Http\Controllers\Controller
{
	public function index() {

        $data = $this->getRecords();

        if (request('search-field')) {
            $data['search-field'] = request('search-field');
        }
        if (request('search-value')) {
            $data['search-value'] = request('search-value'); 
        }
        if (request('success')) {
        	if (request('success') + 3 > date('U')) {
            	$data['success'] = trans ('strings.messages.success'); 
        	}
        }

        return view('module-objects.table',compact('data'));
    }

    public function search($search_field,$search_text) {

        $data = $this->searchRecords($this->getRecords(),$search_field,$search_text);

        return view('module-objects.table-rows',compact('data'));
    }

    public function searchRecords($data,$search_field,$search_text) {

        $suitable_records = array();

        if ($search_text != 'all') {

	        foreach ($data['records'] as $num => $record) {
	        	if ($search_field !== 'all') {
	        		if  (strpos($record[$search_field], $search_text)!==false) {
	        			$suitable_records[$num]=$record;
	        		}
	        		continue;
	        	}
	        	foreach ($data['common-fields'] as $key => $visible_field) {
	        		if ((strpos($record[$visible_field], $search_text)!==false)&&(!isset($suitable_records[$num]))) {
	        			$suitable_records[$num]=$record;
	        		}
	        	}
	        }

	        $data['records'] = $suitable_records;

    	}

    	return $data;

    }


    public function sortRecords($data,$sort_field,$sort_order) {

    	$sort_arr = array();

    	foreach($data['records'] as $record) {
			$sort_arr[] = $record[$sort_field];
		}

		$order = ($sort_order=='asc') ? SORT_ASC : SORT_DESC;

		array_multisort($sort_arr, $order, $data['records']);

		return $data;
    }

    public static function getNew() {

		return static::latest('id')->value('id');
		
	}
}
