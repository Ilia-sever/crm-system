<?php

namespace App\Special\Tools;

use App;
use Carbon\Carbon;

class UnitsConverter
{
    public static function formatCurrency ($sum) {

		return config('settings.currency_prefix').number_format($sum).config('settings.currency_postfix');
    }

}
