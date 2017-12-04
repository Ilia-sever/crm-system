<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function getRecords() {

        if (!$this->model) return;

        $model = $this->model;

        $data['common-fields'] = $this->common_fields;

        $params = array(
            'sort_by' => request('sort') ? request('sort') : $this->default_sort_field,
            'order_by' => request('order') ? request('order') : $this->default_sort_order,
            'search_field' => request('search_field') ? request('search_field') : '',
            'search_value' => request('search_value') ? request('search_value') : '',
            'page' => request('page') ? intval(request('page')) : 1,
        );

        $params['db_sort_possible'] = true;

        if ($params['sort_by']) {

            $params['db_sort_possible'] = $model::isFieldExist($params['sort_by']);
        }

        $data['records'] = $this->filterObjects('watch',$this->module_code,$this->formRecords($params));

        

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

    public function index() {

        abort_if(!auth()->user()->can('watch',$this->module_code),403);

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

    public function delete() {

        if (!$this->model) return;

        $model = $this->model;
        
        if (request('deleting')) {

            foreach (request('deleting') as $deleting_id) {

                $object = $model::find($deleting_id);

                if (!$object) continue;

                if (!auth()->user()->can('delete',$this->module_code,$object)) continue;

                $object->disable();
            }
        }

        return $this->getRecords();  
    }

    protected function filterObjects($action,$module,$objects) {

        foreach ($objects as $num => $object) {

            if (!auth()->user()->can($action,$module,$object)) {
                unset($objects[$num]);
            }
        }

        return $objects;
    }

    protected function protectFields($protected_fields, $data) {

        foreach ($protected_fields as $key => $protected_field) {

            if (!isset($data[$protected_field])) continue;

            if (auth()->user()->can('set_'.$protected_field,$this->module_code)) continue;

            unset($data[$protected_field]);
        }

        return $data;

    }

}
