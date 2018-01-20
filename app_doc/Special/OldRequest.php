<?php

namespace App\Special;

use App;

/**
* Class for getting previous query's values
*
* Класс для получения значений предыдущего запроса
*
* @author Ilia Terebenin
*/
class OldRequest
{
	/**
	* Returns old request value if it exists or empty string
	* 
	* Возвращает значение из предыдущего запроса если оно существует либо пустую строку 
	* 
	* @param string $property
	* @return mixed
	*/
    public function __get ($property) {

    	return request()->old($property);
    }
}
