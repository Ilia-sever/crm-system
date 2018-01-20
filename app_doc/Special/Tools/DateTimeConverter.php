<?php

namespace App\Special\Tools;

use App;
use Carbon\Carbon;

/**
* Class for converting date and time
*
* Класс для операций преобразования даты и времени
*
* @author Ilia Terebenin
*/
class DateTimeConverter
{
    /**
     * Ejects time units from time string
     * 
     * Извлекает единицы времени из строки времени
     * 
     * @param string $str
     * @return array
    */
    protected static function divideTime ($str) {
        // eject time units from '**:**:**'
		return array(
			'hours' => substr($str,0,2),
			'minutes' => substr($str,3,2),
			'seconds' => substr($str,6,2)
		);
    }

    /**
     * Convert time to storage format
     * 
     * Конвертирует время в формат его хранения
     * 
     * @param string $str
     * @return str
    */
    public static function convertTime ($str) {
        // from '** h ** m' to '**:**:**'
        $hours = (is_numeric(substr($str,0,2))) ? substr($str,0,2) : '';

        $minutes = (is_numeric(substr($str,6,2))) ? substr($str,6,2) : '';

        if (!$hours || !$minutes) return '00:00:00';

        if (intval($minutes) > 59) return '00:00:00';

        return $hours.':'.$minutes.':00';
    }

    /**
     * Convert time to view format
     * 
     * Конвертирует время в формат его представления
     * 
     * @param string $str
     * @return str
    */
    public static function formatTime ($str) {
    	// from '**:**:**' to '** h ** m'
    	$time = static::divideTime($str);

    	$formated = '';

    	if ($time['hours']!='00') $formated .= intval($time['hours']) . ' ' .trans('strings.units.hours') . ' ';

    	if ($time['minutes']!='00') $formated .= intval($time['minutes']) . ' ' .trans('strings.units.minutes');

    	return $formated;
    }

    /**
     * Convert date to local view format
     * 
     * Конвертирует дату в формат её локального представления
     * 
     * @param string $str
     * @return str
    */
    public static function formatDate($str) {
    	//from db type to local format
    	if (!$str) return '';
    	return Carbon::parse($str)->format('d.m.Y');
    }


}
