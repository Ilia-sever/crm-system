<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Modules\Task;

abstract class ModuleController extends \App\Http\Controllers\Controller
{
    protected $model = '';
    protected $module_code = '';
    protected $common_fields = '';
    protected $default_sort_field = '';
    protected $default_sort_order = '';

    abstract protected function formRecords($params);

    abstract public function show($params);

    abstract public function add();

    abstract public function create();

    abstract public function edit($id);
    
    abstract public function update();

	public function index() {

        $data['module-code'] = $this->module_code;
        $data['common-fields'] = $this->common_fields;

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

    public function getRecords() {

        $data['module-code'] = $this->module_code;
        $data['common-fields'] = $this->common_fields;

        $params = array(
            'sort_by' => request('sort') ? request('sort') : $this->default_sort_field,
            'order_by' => request('order') ? request('order') : $this->default_sort_order,
            'search_field' => request('search_field') ? request('search_field') : '',
            'search_value' => request('search_value') ? request('search_value') : '',
            'page' => request('page') ? intval(request('page')) : 1,
        );

        $params['db_sort_possible'] = true;

        if ($this->model && $params['sort_by']) {

            $model = $this->model;

            $params['db_sort_possible'] = $model::isFieldExist($params['sort_by']);
        }

        $data['records'] = $this->formRecords($params);

        if ($data['records'] && $params['sort_by'] && !$params['db_sort_possible']) {

            $sort_arr = array();

            foreach($data['records'] as $record) {
                $sort_arr[] = $record[$params['sort_by']];
            }

            $order = ($params['order_by']=='desc') ? SORT_DESC : SORT_ASC;

            array_multisort($sort_arr, $order, $data['records']);

        }

        if ($data['records'] && $params['search_field'] && $params['search_value']) {

            $suitable_records = array();

            $field = $params['search_field'];
            $text = $params['search_value'];

            foreach ($data['records'] as $num => $record) {
                if ($field !== 'all') {
                    if  (strpos($record[$field], $text)!==false) {
                        $suitable_records[$num]=$record;
                    }
                    continue;
                }
                foreach ($data['common-fields'] as $common_field) {
                    if ((strpos($record[$common_field], $text)!==false)&&(!isset($suitable_records[$num]))) {
                        $suitable_records[$num]=$record;
                    }
                }
                var_dump($suitable_records);
            }

            $data['records'] = $suitable_records;
        }

        $page_limit = config('settings.page-limit');

        $records_count = count($data['records']);

        if ($records_count > $page_limit) {

            $pages_count = ceil($records_count / $page_limit);

            $records_start = ($params['page'] - 1) * $page_limit;

            $data['records'] = array_slice($data['records'], $records_start, $page_limit);

            $data['pagination'] = array(
                'count' => $pages_count,
                'current' => $params['page'],
            );

        }

        return view('module-objects.table-rows',compact('data'));
    }

    public function delete() {

        if (!$this->model) return;

        $model = $this->model;
        
        if (request('deleting')) {
            foreach (request('deleting') as $deleting_id) {
                $model::disable($deleting_id);
            }
        }

        return $this->getRecords();  
    }

}
