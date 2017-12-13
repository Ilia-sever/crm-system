<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Input;
use Validator;

use App\Special\OldRequest;
use App\Special\Tools;

use App\Models\Modules;
use App\Models\Modules\Internal\Notification;

class DocumentsController extends ModuleController
{
    protected $model = "\App\Models\Modules\Document";

    protected $module_code = 'documents';

    protected $common_fields = array('name','datetimeof','author');

    protected $default_sort_field = 'datetimeof';
    protected $default_sort_order = 'desc';

    public function show($id) {

        $document = Modules\Document::find($id);


        if (!$document) return '404 ERROR';
        if (!file_exists($document->file_path)) return '404 ERROR';
        if (!$document->isActive()) return '404 ERROR';
        if (!auth()->user()->can('watch','documents',$document)) return '403 ERROR';
        

        $headers = [
        "Cache-Control"=>"public",
        "Content-Description"=>"File Transfer",
        "Content-Type"=> $document->mime_type,
        "Content-Disposition"=>'inline; filename="'.$document->name.'"',
        "Content-Transfer-Encoding"=>"binary",
        ];

        return response()->file($document->file_path,$headers);
    }


    public function download($id) {

        $document = Modules\Document::find($id);

        abort_if(!$document,404);
        abort_if(!file_exists($document->file_path),404);
        abort_if(!auth()->user()->can('watch','documents',$document),403);
        abort_if(!$document->isActive(),410);
        
        return response()->download($document->file_path,$document->name);
    }

    public function add() {

        return redirect('/documents');
    }

    public function create() {

        $data['error'] = trans('strings.messages.upload-failed');

        if (!auth()->user()->can('create','documents')) return response()->json($data);

        if (!request()->hasFile('file')) return response()->json($data);;

        $file = request()->file('file');

        if (!$file->isValid()) return response()->json($data);;

        if ($file->getSize() > $file->getMaxFilesize()) return response()->json($data);;

        if ($file->getError()) {
            $data['error'] =  $file->getErrorMessage();
            return response()->json($data);;
        }

        $file_extensions = config('settings.file_extensions');

        if (!in_array($file->extension(), $file_extensions)) {

            $data['error'] = trans('strings.messages.file-extensions',['extensions'=>implode(', ', $file_extensions)]);
            return response()->json($data);
        }

        $name = $file->getClientOriginalName();

        if(strlen($name) > 100 || strlen($name) < 3) return response()->json($data);

        $name_parts = explode('.', $name);

        array_pop($name_parts);

        $storage_name = Tools\Localizator::translitString(implode('.', $name_parts));

        while (file_exists(config('settings.document_directory') . $storage_name . '.' . $file->extension())) {
            
            $storage_name .= '+';
        }

        $storage_fullname = $storage_name . '.' . $file->extension();

        $file->move(config('settings.document_directory'),$storage_fullname);

        Modules\Document::createObject([
            'name' => $name,
            'datetimeof' => date('Y-m-d H:i:s'),
            'link' => $storage_fullname,
            'author_id' => auth()->user()->id,
        ]);

        $data['error'] = '';

        return response()->json($data);
    }

    public function update() {

        $document = Modules\Document::find(request('id'));

        abort_if(!auth()->user()->can('update','documents',$document),403);

        $request_data = $this->validateRequest(request()->all());

        if ($request_data['errors']->all()) {
            return redirect('/documents/edit/'.$request_data['id'])->withErrors($request_data['errors'])->withInput();
        }

        $request_data['name'] .= '.' . $document->extension;

        $document->updateObject($request_data);

        return redirect('/documents');

    }

    protected function validateRequest($request_data) {

        $errors=Validator::make($request_data,[ 
            'name' => 'min:3|max:90|required',
        ])->errors();

        $request_data['errors'] = $errors;

        return $request_data;
    }

    public function getSelectPanel() {

        if(!auth()->user()->can('watch','documents')) return '';
        
        return view('module-objects.documents.select-panel');
    }

    public function getSelectItems($select_search='') {

        $data['select-items'] = array();

        $documents = Modules\Document::active()->where('name','like',"%$select_search%")->orderBy('datetimeof','desc')->limit(5);

        if ($documents->count()) {

            $data['select-items'] = $this->filterObjects('watch','documents',$documents->get());
        }

        return view('module-objects.documents.select-items',compact('data'));
    }

}