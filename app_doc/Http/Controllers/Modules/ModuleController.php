<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Permission;


/**
* Abstract superclass for modules' controllers
*
* Абстрактный суперкласс для контроллеров все модулей
*
* @author Ilia Terebenin
*/
abstract class ModuleController extends Controller
{
    /**
    * Full name of the class of model corresponding to controller
    *
    * Полное имя класса соответствующей контроллеру модели
    *
    * @var string
    */
    protected $model = '';

    /**
    * Module string code for use in addresses
    *
    * Символьный код модуля для использования в адресах
    *
    * @var string
    */
    protected $module_code = '';

    /**
    * List of fields displayed in the module objects table
    *
    * Список полей, выводимых в таблице объектов модуля
    *
    * @var array
    */
    protected $common_fields = '';

    /**
    * Records sort field in the module objects table
    *
    * Поле сортировки записей в таблице объектов модуля по умолчанию
    *
    * @var string
    */
    protected $default_sort_field = '';

    /**
    * Records sort order in the module objects table
    *
    * Порядок сортировки записей в таблице объектов модуля по умолчанию
    *
    * @var string
    */
    protected $default_sort_order = '';

    /**
    * Processes a request to object's creating 
    *
    * Обрабатывает запрос на создание объекта
    *
    * @return object
    */
    abstract public function create();

    /**
    * Processes a request to object's updating
    *
    * Обрабатывает запрос на редактирование объекта
    *
    * @return object
    */
    abstract public function update();

    /**
    * Forms an array of objects based on the request parameters and 
    * returns it's output as table entries of the module's objects
    *
    * Формирует на основании параметров запроса массив объектов и возвращает его вывод 
    * в виде записей таблицы объектов модуля 
    *
    * @return object
    */
    public function getRecords() {

        if (!$this->model) return;

        $model = $this->model;

        $data['common-fields'] = $this->common_fields;

        $common_real_fields = $this->common_fields;

        foreach ($common_real_fields as $num => $common_real_field) {

            if (method_exists($model, camel_case('get_formated_'.$common_real_field))) {

                $common_real_fields[$num] = 'formated_' . $common_real_field;
            }
        }

        $params = array(
            'sort_by' => request('sort') ? request('sort') : $this->default_sort_field,
            'order_by' => request('order') ? request('order') : $this->default_sort_order,
            'search_field' => request('search_field') ? request('search_field') : '',
            'search_value' => request('search_value') ? request('search_value') : '',
            'page' => request('page') ? intval(request('page')) : 1,
        );

        if ($params['search_field']) {

            $formated_search_field = 'formated_'.$params['search_field'];

            if (in_array($formated_search_field, $common_real_fields)) {

                $params['search_field'] = $formated_search_field;
            }
        }

        $params['db_sort_possible'] = ($params['sort_by']) ? $model::isFieldExist($params['sort_by']) : true;

        $params['db_search_possible'] = ($params['search_field']) ? $model::isFieldExist($params['search_field']) : true;

        $data['records'] = $this->filterObjects('watch',$this->module_code,$model::getObjects($params)->all());

        //not-db sorting
        if ($data['records'] && !$params['db_sort_possible']) {

            $sort_arr = array();

            foreach($data['records'] as $record) {
                $sort_arr[] = $record->$params['sort_by'].'';
            }

            $order = ($params['order_by']=='desc') ? SORT_DESC : SORT_ASC;

            array_multisort($sort_arr, $order, $data['records']);

        }

        //not-db searching
        if ($data['records'] && $params['search_value'] && !$params['db_search_possible']) {

            $suitable_records = array();

            $field = $params['search_field'];
            $text = $params['search_value'];

            foreach ($data['records'] as $num => $record) {

                if ($field !== 'all') {
                    if  (strpos($record->$field, $text)===false) {
                        unset($data['records'][$num]);
                    }
                    continue;
                }

                $is_concurrences = false;

                foreach ($common_real_fields as $common_real_field) {
                    if ((strpos($record->$common_real_field, $text)!==false)) {
                        $is_concurrences = true;
                        break;
                    }
                }

                if (!$is_concurrences) unset($data['records'][$num]);
            }
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

        if (view()->exists('modules.'.$this->module_code.'.table-rows')) {

            return view('modules.'.$this->module_code.'.table-rows',compact('data'));
        }

        return view('modules.table-rows',compact('data'));
    }

    /**
    * Gets the necessary data and forms a modules objects' table page
    *
    * Получает необходимые данные и формирует страницу таблицы объектов модуля
    *
    * @return object
    */
    public function index() {

        abort_if(!auth()->user()->can('watch',$this->module_code),403);

        $data['common-fields'] = $this->common_fields;

        return view('modules.table',compact('data'));
    }

    /**
    * Forms a modules object's detailed view page
    *
    * Формирует страницу детального просмотра объекта модуля
    *
    * @param string $id
    * @return object
    */
    public function show($id) {

        abort_if(!is_numeric($id),404);

        $model=$this->model;

        $data = array();

        $object = $model::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('watch',$this->module_code,$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        return view('modules.'.$this->module_code.'.show',compact('data'));
    }

    /**
    * Forms a modules object's adding page
    *
    * Формирует страницу создания объекта модуля
    *
    * @return object
    */
    public function add() {

        abort_if(!auth()->user()->can('create',$this->module_code),403);

        $data = array();

        $data['object'] = new OldRequest();

        $data = $this->addFormData($data);

        return view('modules.'.$this->module_code.'.control',compact('data'));
    }

    /**
    * Forms a modules object's editing page
    *
    * Формирует страницу редактирования объекта модуля
    *
    * @return object
    */
    public function edit($id) {

        abort_if(!is_numeric($id),404);

        $model=$this->model;

        $data = array();

        $object = $model::find($id);

        abort_if(!$object,404);
        abort_if(!auth()->user()->can('update',$this->module_code,$object),403);
        abort_if(!$object->isActive(),410);

        $data['object'] = $object;

        $data = $this->addFormData($data);

        return view('modules.'.$this->module_code.'.control',compact('data'));
    }

    /**
    * Processes a request to module objects' deleting
    *
    * Обрабатывает запрос на удаление объектов модуля
    *
    * @return string
    */
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

        return 'success';  
    }

    /**
    * Gets additional data for module object's adding/editing pages
    *
    * Получает дополнительные данные для страниц создания и редактирования объектов модуля
    *
    * @param array $data
    * @return array
    */
    protected function addFormData($data) {

        return $data;
    }  

    /**
    * Filters an array of module objects based on user access to these objects
    *
    * Фильтрует массив объектов модуля на основе доступа пользователя к данным объектам
    *
    * @param string $action
    * @param string $module
    * @param array $objects
    * @return array
    */
    protected function filterObjects($action,$module,$objects) {

        if (auth()->user()->can($action,$module,'',false)) {

            if (Permission::isObjectCheckingRequired($action)) {

                return $objects;
            }
        }

        foreach ($objects as $num => $object) {

            if (!auth()->user()->can($action,$module,$object)) {
                unset($objects[$num]);
            }
        }

        return $objects;
    }

    /**
    * Filters the data of request to object's creating/updating 
    * according to user's access to these objects
    *
    * Фильтрует данные запроса создания/редактирования объекта на основе доступа пользователя
    * к установке этих данных
    *
    * @param array $protected_fields
    * @param array $data
    * @return array
    */
    protected function protectFields($protected_fields, $data) {

        foreach ($protected_fields as $key => $protected_field) {

            if (!isset($data[$protected_field])) continue;

            if (auth()->user()->can('set_'.$protected_field,$this->module_code)) continue;

            unset($data[$protected_field]);
        }

        return $data;

    }

    /**
    * Validates the data of request to module object's creating/updating 
    *
    * Проводит валидацию данных запроса на создание/редактирование объекта модуля
    *
    * @param array $request_data
    * @param object $object
    * @return array
    */
    protected function validateRequest($request_data,$object=null) {
    }

}
