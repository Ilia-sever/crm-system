<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;

use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

class TransactionsController extends ModuleController
{
    protected $model = "\App\Models\Modules\Transaction";

    protected $module_code = 'transactions';

    protected $common_fields = array('type','kind','sum','datetimeof','assignment');

    protected $default_sort_field = 'datetimeof';
    protected $default_sort_order = 'desc';

    protected function addFormData($data) {

        $data['transaction_types'] = Modules\Internal\TransactionType::all();

        $data['projects'] = $this->filterObjects('watch','projects',Modules\Project::getActive());

        $data['clients'] = $this->filterObjects('watch','clients',Modules\Client::getActive());

        $data['employees'] = $this->filterObjects('watch','employees',Modules\Employee::getActive());

        return $data;
    }  

    public function create() {

        abort_if(!auth()->user()->can('create','transactions'),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/transactions/add/')->withErrors($request_data['errors'])->withInput();
        }

        $request_data['datetimeof'] = date('Y-m-d H:i:s');
        $request_data['author_id'] = auth()->user()->id;

        $transaction = Modules\Transaction::createObject($request_data);

        if (($request_data['employee_id'])) {
            Notification::notifyAboutTransaction($transaction, $request_data['employee_id']);
        }

        return redirect('/transactions/show/'.$transaction->id);
  
    }

    public function update() {

        $transaction = Modules\Transaction::find(request('id'));

        abort_if(!auth()->user()->can('update','transactions',$transaction),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/transactions/edit/'.$request_data['id'])->withErrors($request_data['errors'])->withInput();
        }

        if ($request_data['employee_id'] && $request_data['employee_id'] != $transaction->employee_id) {
            Notification::notifyAboutTransaction($transaction, $request_data['employee_id']);
        }

        $transaction->updateObject($request_data);

        return redirect('/transactions/show/'.$transaction->id);

    }

    protected function validateRequest($request_data) {

        $errors=Validator::make($request_data,[ 
            'type_id' => 'numeric',
            'sum' => 'numeric|required',
            'project_id' => 'numeric|nullable',
            'client_id' => 'numeric|nullable',
            'employee_id' => 'numeric|nullable',
            'comment' => 'min:5|max:1000|nullable',  
        ])->errors();

        if (!isset($request_data['type_id']) || !Modules\Internal\TransactionType::find($request_data['type_id'])) {

            $errors->add('type',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.type')]));
        }

        if ($request_data['project_id'] && !Modules\Project::find($request_data['project_id'])) {

            $errors->add('project',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.project')]));
        }

        if ($request_data['client_id'] && !Modules\Client::find($request_data['client_id'])) {

            $errors->add('client',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.client')]));
        }

        if ($request_data['employee_id'] && !Modules\Employee::find($request_data['employee_id'])) {

            $errors->add('employee',trans('strings.messages.invalid-value', ['field' => trans('strings.fields-name.employee')]));
        }

        $request_data['errors'] = $errors;

        return $request_data;
    }

    public function editTypes() {

        abort_if(!auth()->user()->can('setup_types','transactions'),403);
        
        $data['transaction_types'] = Modules\Internal\TransactionType::all();

        return view('module-objects.transactions.types-control',compact('data'));
    }

    public function saveTypes() {

        abort_if(!auth()->user()->can('setup_types','transactions'),403);

        $request_data = request()->all();

        $types_id = array();

        if (!isset($request_data['types_name'])) $request_data['types_name'] = array();

        foreach ($request_data['types_name'] as $id => $value) {

            $type = array();

            if (Modules\Internal\TransactionType::isExist($id)) {

                $type['id'] = $id;
                $types_id[] = $id;
            }

            $type['name'] = $value;

            foreach (['income','indicate_project','indicate_client','indicate_employee'] as $flag) {

                $type[$flag] = null;

                if (!isset($request_data['types_'.$flag])) continue;

                $type[$flag] = array_key_exists($id, $request_data['types_'.$flag]) ? 1 : null;
            }

            $errors = Validator::make($type, [
                'name'=>'max:100|required',
            ])->errors();

            if ($errors->all()) {
                
                return redirect('/transactions/types/edit')->withErrors($errors)->withInput();
            }

            $object = null;

            if (!Modules\Internal\TransactionType::isExist($id)) {

                $object = Modules\Internal\TransactionType::create($type);
                
            } else {

                $object = Modules\Internal\TransactionType::find($type['id']);
                $object->updateObject($type);
            }

            $types_id[] = $object->id;
        }

        Modules\Internal\TransactionType::whereNotIn('id',$types_id)->delete();

        return redirect('/transactions');
        
    }

}