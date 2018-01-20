<?php

namespace App\Models;

use App;

use Illuminate\Database\Eloquent\Model;

/**
* Permissions objects model
*
* Модель объектов разрешений
*
* @author Ilia Terebenin
*/
class Permission extends MainModel
{
    /**
    * Checks permission's existence according to the parameters
    *
    * Проверяет наличие разрешения согласно параметрам
    * @param string $role_id
    * @param string $action_id
    * @param string $module_id
    * @return bool
    */
    public static function isGiven($role_id,$action_id,$module_id) {
    	return (static::all()->where('role_id', $role_id)->where('action_id',$action_id)->where('module_id',$module_id)->count() > 0) ? true : false;
    }

    /**
    * Checks the need to check access to a specific object
    *
    * Проверяет необходимость проверки доступа к конкретному объекту
    * @param string $role_id
    * @param string $action_id
    * @param string $module_id
    * @return bool
    */
    public static function isObjectCheckingRequired($action_name) {

        if (method_exists(static::class, camel_case('check_'.$action_name))) {

            return true;
        }
        return false;
    }

    /**
    * Checks for access to object
    *
    * Проверяет доступ к объекту
    * @param string $role_id
    * @param string $action_id
    * @param string $module_id
    * @return bool
    */
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
