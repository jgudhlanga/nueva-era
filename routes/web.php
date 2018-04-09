<?php

Route::get('/home', function () {
    return view('home.index');
})->middleware('auth');

Route::get('/', function () {
    return view('home.index');
})->middleware('auth');

Auth::routes();

/* CPANEL ROUTES */
Route::prefix('cpanel')->group(function () {
	
	/*GENERAL*/
	Route::prefix('general')->middleware('role:senior-developer|junior-developer|administrator')->group(function () {
		Route::get('manager/{model}', 'CPanel\General\GeneralController@manager')->name('cpanel.general.manager')->middleware('auth');
		Route::post('manager/{model}', 'CPanel\General\GeneralController@store')->name('cpanel.general.store')->middleware('auth');
		Route::get('manager/{model}/{id}', 'CPanel\General\GeneralController@edit')->name('cpanel.general.edit')->middleware('auth');
		Route::put('manager/{model}/{id}', 'CPanel\General\GeneralController@update')->name('cpanel.general.update')->middleware('auth');
		Route::put('manager/{model}/{id}/status', 'CPanel\General\GeneralController@changeStatus')->name('cpanel.general.change_status')->middleware('auth');
		Route::delete('manager/{model}/{id}', 'CPanel\General\GeneralController@destroy')->name('cpanel.general.destroy')->middleware('auth');
	});
	
	/*MODULES & PAGES */
	Route::prefix('modules')->middleware('role:senior-developer')->group(function () {
		Route::resource('pages', 'CPanel\Modules\PageController')->middleware('auth');
	});
	Route::resource('modules', 'CPanel\Modules\ModuleController')->middleware('role:senior-developer')->middleware('auth');
	
	/*SECURITY*/
	Route::prefix('security')->middleware('role:senior-developer')->group(function () {
		Route::resource('roles', 'CPanel\Security\RolesController')->middleware('auth');
		Route::prefix('permissions')->group(function () {
			Route::post('store-crud', 'CPanel\Security\PermissionsController@storeCrud')->middleware('auth');
		});
		Route::resource('permissions', 'CPanel\Security\PermissionsController')->middleware('auth');
	});
});

Route::resource('cpanel', 'CPanel\Index\CPanelController')->middleware('auth');

/*Chms  Routes*/
Route::resource('chms', 'Chms\Index\ChmsController')->middleware('auth');

/*Hms Routes*/
Route::resource('hms', 'Hms\Index\HmsController')->middleware('auth');

/*Members Routes*/
Route::resource('members', 'Members\MembersController')->middleware('auth');

/*Procurement Routes*/
Route::resource('procurement', 'Procurement\Index\ProcurementController')->middleware('auth');

/*USERS ROUTES*/
Route::resource('users', 'Users\UsersController')->middleware('auth');

/*ERROR ROUTES*/
Route::get('403', 'Errors\ErrorsController@forbidden');