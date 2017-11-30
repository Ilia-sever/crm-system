<?php

namespace App\Special\Tools;

use App;
use Carbon\Carbon;

class DateTimeConverter
{
    protected static function divideTime ($str) {
        // eject time units from '**:**:**'
		return array(
			'hours' => substr($str,0,2),
			'minutes' => substr($str,3,2),
			'seconds' => substr($str,6,2)
		);
    }

    public static function convertTime ($str) {
        // from '** h ** m' to '**:**:**'
        $hours = (is_numeric(substr($str,0,2))) ? substr($str,0,2) : '';

        $minutes = (is_numeric(substr($str,6,2))) ? substr($str,6,2) : '';

        if (!$hours || !$minutes) return '00:00:00';

        if (intval($minutes) > 59) return '00:00:00';

        return $hours.':'.$minutes.':00';
    }

    public static function formatTime ($str) {
    	// from '**:**:**' to '** h ** m'
    	$time = static::divideTime($str);

    	$formated = '';

    	if ($time['hours']!='00') $formated .= intval($time['hours']) . ' ' .trans('strings.units.hours') . ' ';

    	if ($time['minutes']!='00') $formated .= intval($time['minutes']) . ' ' .trans('strings.units.minutes');

    	return $formated;
    }

    public static function formatDate($str) {
    	//from db type to local format
    	if (!$str) return '';
    	return Carbon::parse($str)->format('d.m.Y');
    }


}
