<?php

namespace App\Models\Modules;

use App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;

class ModuleModel extends Model
{
    public $timestamps = false;
	protected $guarded = [];

	public function isActive() {
		return ($this->enable=='0') ? false: true;
	}

	public static function getActive() {
		return static::where('enable','1')->get();
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

	public static function getSorted($sort_field,$sort_order) {
		return static::where('enable','1')->orderBy($sort_field,$sort_order)->get();
	}

	protected static function getTime ($str) {
        // convert from '**:**:**'
		return array(
			'hours' => substr($str,0,2),
			'minutes' => substr($str,3,2),
			'seconds' => substr($str,6,2)
		);
    }

    protected static function formatDate($str) {

    	return Carbon::parse($str)->format('d.m.Y');
    }

    public static function getNew() {

		return static::latest('id')->value('id');
		
	}
}
