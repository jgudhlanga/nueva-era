<?php

use Illuminate\Http\Request;

/* CPANEL ROUTES */
Route::group(['prefix' => 'cpanel'], function (){
	
	/* MODULES && PAGES */
	Route::group(['prefix' => 'modules'], function () {
		Route::get('/get-modules', 'CPanel\Modules\Api\ModuleController@getModules');
		Route::put('/change-module-status/{module}', 'CPanel\Modules\Api\ModuleController@changeStatus');
		Route::put('/order-modules/{module}', 'CPanel\Modules\Api\ModuleController@order');
		
		/*PAGES*/
		Route::group(['prefix' => 'pages'], function (){
			Route::get('/get-pages/{module}', 'CPanel\Modules\Api\PageController@getPages');
			Route::put('/change-page-status/{page}', 'CPanel\Modules\Api\PageController@changeStatus');
			Route::put('/order-pages/{page}', 'CPanel\Modules\Api\PageController@order');
		});
		
	});
	
	/* GENERAL */
	Route::group(['prefix' => 'general'], function (){
		Route::group(['prefix' => 'countries'], function () {
			Route::put('/change-status/{country}', 'CPanel\General\Countries\Api\CountriesController@changeStatus');
			Route::get('/get-countries', 'CPanel\General\Countries\Api\CountriesController@getCountries');
		});
	});
	
	/* SECURITY */
	Route::group(['prefix' => 'security'], function (){
		//PERMISSIONS
		Route::group(['prefix' => 'permissions'], function () {
			Route::get('/get-permissions', 'CPanel\Security\Api\PermissionsController@getPermissions');
			Route::put('/change-status/{permission}', 'CPanel\Security\Api\PermissionsController@changeStatus');
		});
		//ROLES
		Route::group(['prefix' => 'roles'], function() {
			Route::put('/change-status/{role}', 'CPanel\Security\Api\RolesController@changeStatus');
		});
	});
});

/* USERS ROUTES */
Route::group(['prefix' => 'users'], function () {
	Route::get('/get-users', 'Users\Api\UsersController@getUsers');
	Route::put('/change-user-status/{user}', 'Users\Api\UsersController@changeStatus');
	Route::put('upload-profile-picture/{user}', 'Users\Api\UsersController@uploadProfilePicture')->name('users.upload-profile-picture');
});

/*AUTH ROUTE*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*PRODUCTS ROUTE*
Route::apiResource('/products', 'Products\Api\ProductController');/

/*PRODUCT REVIEW ROUTES
Route::group(['prefix' => 'products'], function (){
	Route::apiResource('/{product}/reviews', 'Reviews\Api\ReviewController');
});*/

/*USER ROUTES
Route::apiResource('/users', 'Users\Api\UsersController');*/



