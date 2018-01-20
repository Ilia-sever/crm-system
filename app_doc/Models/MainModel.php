<?php

namespace App\Models;

use App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

/**
* Models' superclass with a number of method for object's getting and managing
*
* Суперкласс моделей с рядом методов по генерации и управлению объектами
*
* @author Ilia Terebenin
*/
class MainModel extends Model
{
    public $timestamps = false;
	protected $guarded = [];

    /**
    * Returns the name of the database table that corresponds to the model
    *
    * Возвращает имя таблицы БД, которая соответствует модели
    *
    * @return string
    */
    public static function table() {
        
        return with(new static)->getTable();
    }

    /**
    * Magic method for search of object's absent field in getters-methods
    *
    * Магический метод для поиска отсутствующего свойства объекта через get-методы
    *
    * @return string
    */
	public function __get($property) {

        $prop = Model::__get($property);

        if ($prop) return $prop;

        //finding getter-method for property

        $getter = camel_case('get_'.$property);

        if (method_exists($this, $getter)) {
            return $this->$getter();
        }

        return '';
    }

    /**
    * Сonverts object's incoming data into a database storage format
    *
    * Конвертирует поступающие в объект данные в формат их хранения в БД
    *
    * @param array $data
    * @return array
    */
    protected static function convertRequest($data) {

        return $data;
    }

    /**
    * Removes from the object's creating/updating request non-existent properties of its record in DB 
    *
    * Удаляет из запроса создания/изменения объекта 
    * отстувтующие свойства его записи в БД
    *
    * @param array $data
    * @return array
    */
    protected static function filterRequest($data) {

        $table = static::table();

        foreach ($data as $column => $value) {
            if (!Schema::hasColumn($table, $column) || $column=='id') unset($data[$column]);
        }

        return $data;
    }

    /**
    * Safely create a new object, storing it in a DB
    *
    * Безопасно создает новый объект, сохраняя его в БД
    *
    * @param array $data
    * @return object
    */
	public static function createObject($data) {

        if (!$data) return;

        $data = static::convertRequest($data);

        $data = static::filterRequest($data);

        return static::create($data);
    }

    /**
    * Safely update an object's data, storing it in a DB
    *
    * Безопасно изменяет данные объекта, сохраняя их в БД
    *
    * @param array $data
    * @return void
    */
    public function updateObject($data) {

    	if (!$data) return;

        $data['id'] = $this->id;

        $data = static::convertRequest($data);

    	$data = static::filterRequest($data);

    	$this->update($data);
    }

    /**
    * Checks object's existence by id
    *
    * Проверяет существование объекта по id
    *
    * @param string $id
    * @return bool
    */
	public static function isExist($id) {
		return (static::where('id',$id)->count()>0) ? true : false;
	}

    /**
    * Checks the existence of a field in the model's DB table
    *
    * Проверяет существование поля в соответствующей модели таблице БД
    *
    * @param string $str
    * @return bool
    */
	public static function isFieldExist($str) {
		//return (isset(static::all()->first()->value($str))) ? true : false;
		//return with(new static)->getTable();;
		//$record = static::all()->first()->get();
		//var_dump($record);
		return Schema::hasColumn(with(new static)->getTable(), $str);
	}

    /**
    * Returns the latest object's id
    *
    * Вовзращает id последнего созданного объекта
    *
    * @return string
    */
    public static function getNew() {
        return static::latest('id')->value('id');
    }

    /**
    * Gets objects sorted by the parameters
    *
    * Получает отсортированные объекты согласно параметрам
    *
    * @param string $sort_field
    * @param string $sort_order
    * @return \Illuminate\Database\Eloquent\Collection
    */
    public static function getSorted($sort_field,$sort_order) {
        return static::orderBy($sort_field,$sort_order)->get();
    }
}
