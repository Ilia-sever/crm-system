<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(array('middleware' =>'auth'), function()
{

Route::get('/', 'HomeController@index');

Route::post('/complete', 'HomeController@completingTask');

$modules = \App\Models\Module::getModulesList();

foreach ($modules as $key => $module) {

	$module_low = mb_strtolower($module);

	Route::get('/'.	$module_low,'Modules\\'.				$module.'Controller@index');

	Route::get('/'.	$module_low.'/getRecords','Modules\\'.	$module.'Controller@getRecords');

	Route::get('/'.	$module_low.'/show/{id}','Modules\\'.	$module.'Controller@show');
	Route::get('/'.	$module_low.'/add','Modules\\'.			$module.'Controller@add');
	Route::get('/'.	$module_low.'/edit/{id}','Modules\\'.	$module.'Controller@edit');
	
	Route::post('/'.$module_low.'/create','Modules\\'.		$module.'Controller@create');
	Route::post('/'.$module_low.'/update','Modules\\'.		$module.'Controller@update');
	Route::post('/'.$module_low.'/delete','Modules\\'.		$module.'Controller@delete');
}

Route::post('/projects/flows_stages_modal','Modules\ProjectsController@getFlowsStagesModal');

Route::get('/flows/control/{project_id}/{id}','Modules\Internal\FlowsController@control');
Route::post('/flows/save','Modules\Internal\FlowsController@save');
Route::post('/flows/delete','Modules\Internal\FlowsController@delete');

Route::get('/stages/control/{flow_id}/{id}','Modules\Internal\StagesController@control');
Route::post('/stages/save','Modules\Internal\StagesController@save');
Route::post('/stages/delete','Modules\Internal\StagesController@delete');

Route::get('/transactions/types/edit','Modules\TransactionsController@editTypes');
Route::post('/transactions/types/save','Modules\TransactionsController@saveTypes');

Route::get('/documents/download/{id}','Modules\DocumentsController@download');
Route::get('/documents/select_panel','Modules\DocumentsController@getSelectPanel');
Route::get('/documents/get_select_items/{select_search?}','Modules\DocumentsController@getSelectItems');

Route::get('/help', function () {
	return view('static.help');
});

});

