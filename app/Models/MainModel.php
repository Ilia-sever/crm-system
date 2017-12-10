<?php

namespace App\Models;

use App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class MainModel extends Model
{
    public $timestamps = false;
	protected $guarded = [];

    public static function table() {
        
        return with(new static)->getTable();
    }

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

    protected static function convertRequest($data) {

        return $data;
    }

    protected static function filterRequest($data) {

        $table = static::table();

        foreach ($data as $column => $value) {
            if (!Schema::hasColumn($table, $column) || $column=='id') unset($data[$column]);
        }

        return $data;
    }

	public static function createObject($data) {

        if (!$data) return;

        $data = static::convertRequest($data);

        $data = static::filterRequest($data);

        return static::create($data);
    }

    public function updateObject($data) {

    	if (!$data) return;

        $data['id'] = $this->id;

        $data = static::convertRequest($data);

    	$data = static::filterRequest($data);

    	$this->update($data);

    }

	public static function isExist($id) {
		return (static::where('id',$id)->count()>0) ? true : false;
	}

	public static function isFieldExist($str) {
		//return (isset(static::all()->first()->value($str))) ? true : false;
		//return with(new static)->getTable();;
		//$record = static::all()->first()->get();
		//var_dump($record);
		return Schema::hasColumn(with(new static)->getTable(), $str);
	}

    public static function getNew() {
        return static::latest('id')->value('id');
    }

    public static function getSorted($sort_field,$sort_order) {
        return static::orderBy($sort_field,$sort_order)->get();
    }
}
