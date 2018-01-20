<?php

namespace App\Special\Tools;

use App;
use Carbon\Carbon;

/**
* Class for converting different values
*
* Класс для конвертации различных величин
*
* @author Ilia Terebenin
*/
class UnitsConverter
{
	/**
	 * Convert money sum to view with currency
	 * 
	 * Конвертирует денежную строку в представление с валютой
	 * 
	 * @param int $sum
	 * @return str
	*/
    public static function formatCurrency ($sum) {

		return config('settings.currency_prefix').number_format($sum).config('settings.currency_postfix');
    }

}
