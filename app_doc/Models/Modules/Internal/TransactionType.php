<?php

namespace App\Models\Modules\Internal;

use Illuminate\Database\Eloquent\Model;

use App;
use App\Models\MainModel;
use App\Models;
use App\Models\Role;
use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

/**
* Transactions types objects model
*
* Модель объектов типов транзакций
*
* @author Ilia Terebenin
*/
class TransactionType extends MainModel
{
	public function __toString() {
		
		return $this->name;
	}
	
}
