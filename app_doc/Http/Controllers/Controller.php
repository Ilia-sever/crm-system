<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
* The base class for creating application controllers, inherited from the BaseController system class, 
* connects the traits required for requests' processing
*
* Базовый класс для создания контроллеров приложения, наледуется от системного класса BaseController, * подключает необходимые для обработки запросов трейты  
*
*/
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
