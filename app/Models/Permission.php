<?php

namespace App\Models;

use App;

use Illuminate\Database\Eloquent\Model;

class Permission extends MainModel
{
    public static function isGiven($role_id,$action_id,$module_id) {
    	return (static::all()->where('role_id', $role_id)->where('action_id',$action_id)->where('module_id',$module_id)->count() > 0) ? true : false;
    }

    public static function isObjectCheckingRequired($action_name) {

        if (method_exists(static::class, camel_case('check_'.$action_name))) {

            return true;
        }
        return false;
    }

    public static function checkObject($action_name,$object) {

        $checking_method = camel_case('check_'.$action_name);

        if (!method_exists(static::class, $checking_method)) return false;

        return static::$checking_method($object);
    }

    public static function checkWatchRelated($object) {
        return $object->isRelatedEmployee(auth()->user()->id);
    }

    public static function checkUpdateRelated($object) {
        return $object->isRelatedEmployee(auth()->user()->id);
    }

    public static function checkDeleteRelated($object) {
        return $object->isRelatedEmployee(auth()->user()->id);
    }

    public static function checkWatchControlled($object) {
    	return $object->isControlledEmployee(auth()->user()->id);
    }

    public static function checkUpdateControlled($object) {
    	return $object->isControlledEmployee(auth()->user()->id);
    }

    public static function checkDeleteControlled($object) {
    	return $object->isControlledEmployee(auth()->user()->id);
    }
}
