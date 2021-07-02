<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

/*
|----------------------------------------------
    frontend website Routes
|-----------------------------------------------
*/

Route::get('/', 'frontend\PagesController@index')->name('index');
Route::get('/search', 'frontend\PagesController@products_search')->name('products.search');

//Api route here for Division and District
Route::get('get-districts/{id}', function($id){
   return json_encode(App\Models\District::where('division_id', $id)->get());
});

/*
|----------------------------------------------
    frontend users route are here
|-----------------------------------------------
*/
	Route::group(['prefix' => 'user'], function(){
		Route::get('/token/{token}', 'Auth\VerificationController@verify')->name('user.verifyRegistation');
		Route::get('/dashboard', 'frontend\UsersController@dashboard')->name('user.dashboard');
		Route::get('/profile', 'frontend\UsersController@profile')->name('user.profile');
		Route::post('/profile/update', 'frontend\UsersController@update')->name('user.profile.update');
	});
/*
|----------------------------------------------
    frontend products route are here
|-----------------------------------------------
*/
	Route::group(['prefix' => 'products'], function(){
		Route::get('/', 'frontend\ProductsController@products')->name('products');
		Route::get('/{product_slug}', 'frontend\ProductsController@show')->name('products.show');

		//category route are here
		Route::get('/categories', 'frontend\CategoriesController@index')->name('categories.index');
		Route::get('/category/{id}', 'frontend\CategoriesController@show')->name('categories.show');



    });

    //cart route are here
    Route::group(['prefix' => 'carts'], function(){
        Route::get('/', 'frontend\CartController@index')->name('carts');
        Route::post('/store', 'frontend\CartController@store')->name('carts.store');
        Route::post('/update/{id}', 'frontend\CartController@update')->name('carts.update');
        Route::post('/delete/{id}', 'frontend\CartController@destory')->name('carts.delete');
    });
    //checkouts route are here
    Route::group(['prefix' => 'checkouts'], function(){
        Route::get('/', 'frontend\CheckOutController@index')->name('checkouts');
        Route::post('/store', 'frontend\CheckOutController@store')->name('checkouts.store');
    });

/*
|----------------------------------------------
    backend route are here
|-----------------------------------------------
*/

Route::group(['prefix' => 'admin'], function(){
    //Dashboard Route are here
    Route::get('/', 'backend\DashboardController@index')->name('admin.dashboard');
    //Login Route
	Route::get('/login', 'backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'backend\Auth\LoginController@login')->name('admin.login.submit');
    //Logout Route are here
    Route::post('/logout/submit', 'backend\Auth\LoginController@logout')->name('admin.logout.submit');
    //Roles Route are here
    Route::resource('roles', 'backend\RolesController', ['names'=>'admin.roles']);
    Route::resource('admins', 'backend\AdminsController', ['names'=>'admin.admins']);
    Route::resource('users', 'backend\UserController', ['names'=>'admin.users']);
/*
|----------------------------------------------
   admin page Product Route are here
|-----------------------------------------------
*/
	Route::group(['prefix' => 'product'], function(){
		Route::get('/manage', 'backend\ProductController@index')->name('admin.product.manage');
		Route::get('/create', 'backend\ProductController@create')->name('admin.product.create');
		Route::post('/store', 'backend\ProductController@store')->name('admin.product.store');
		Route::get('/view/{id}', 'backend\ProductController@view')->name('admin.product.view');
		Route::get('/edit/{id}', 'backend\ProductController@edit')->name('admin.product.edit');
		Route::post('/update/{id}', 'backend\ProductController@update')->name('admin.product.update');
		Route::post('/delete/{id}', 'backend\ProductController@delete')->name('admin.product.delete');

		Route::get('/deactive_product/{id}','backend\ProductController@deactive_product')->name('admin.product.deactiveproduct');
		Route::get('/active_product/{id}','backend\ProductController@active_product')->name('admin.product.activeproduct');
	});

/*
|----------------------------------------------
   admin page Product Route are here
|-----------------------------------------------
*/
Route::group(['prefix' => 'order'], function(){
    Route::get('/manage', 'backend\OrderController@index')->name('admin.order.manage');
    Route::get('/view/{id}', 'backend\OrderController@show')->name('admin.order.show');
    Route::post('/delete/{id}', 'backend\OrderController@delete')->name('admin.order.delete');
    //update admin seen status
    Route::get('/admin_seen/{id}', 'backend\OrderController@admin_seen')->name('admin.order.adminseen');
    Route::get('/admin_unseen/{id}', 'backend\OrderController@admin_unseen')->name('admin.order.adminunseen');
    //payment status
    Route::get('/paid/{id}', 'backend\OrderController@paid')->name('admin.order.paid');
    Route::get('/due/{id}', 'backend\OrderController@due')->name('admin.order.due');
    //order status
    Route::get('/completed/{id}', 'backend\OrderController@completed')->name('admin.order.completed');
    Route::get('/panding/{id}', 'backend\OrderController@panding')->name('admin.order.panding');
});


/*
|----------------------------------------------
   admin page Category Route are here
|-----------------------------------------------
*/

	Route::group(['prefix' => 'category'], function(){
		Route::get('/manage', 'backend\CategoryController@index')->name('admin.category.manage');
		Route::get('/create', 'backend\CategoryController@create')->name('admin.category.create');
		Route::post('/store', 'backend\CategoryController@store')->name('admin.category.store');
		Route::get('/edit/{id}', 'backend\CategoryController@edit')->name('admin.category.edit');
		Route::post('/update/{id}', 'backend\CategoryController@update')->name('admin.category.update');
		Route::post('/delete/{id}', 'backend\CategoryController@delete')->name('admin.category.delete');

		Route::get('/deactive_category/{id}','backend\CategoryController@deactive_category')->name('admin.category.deactivecategory');
		Route::get('/active_category/{id}','backend\CategoryController@active_category')->name('admin.category.activecategory');
	});


/*
|----------------------------------------------
   admin page Brands Route are here
|-----------------------------------------------
*/

	Route::group(['prefix' => 'brands'], function(){
		Route::get('/manage', 'backend\BrandController@index')->name('admin.brand.manage');
		Route::get('/create', 'backend\BrandController@create')->name('admin.brand.create');
		Route::post('/store', 'backend\BrandController@store')->name('admin.brand.store');
		Route::get('/edit/{id}', 'backend\BrandController@edit')->name('admin.brand.edit');
		Route::post('/update/{id}', 'backend\BrandController@update')->name('admin.brand.update');
		Route::post('/delete/{id}', 'backend\BrandController@delete')->name('admin.brand.delete');

		Route::get('/deactive_brand/{id}','backend\BrandController@deactive_brand')->name('admin.brand.deactivebrand');
		Route::get('/active_brand/{id}','backend\BrandController@active_brand')->name('admin.brand.activebrand');
	});

/*
|----------------------------------------------
   admin page District Route are here
|-----------------------------------------------
*/

	Route::group(['prefix' => 'districts'], function(){
		Route::get('/manage', 'backend\DistrictController@index')->name('admin.district.manage');
		Route::get('/create', 'backend\DistrictController@create')->name('admin.district.create');
		Route::post('/store', 'backend\DistrictController@store')->name('admin.district.store');
		Route::get('/edit/{id}', 'backend\DistrictController@edit')->name('admin.district.edit');
		Route::post('/update/{id}', 'backend\DistrictController@update')->name('admin.district.update');
		Route::post('/delete/{id}', 'backend\DistrictController@delete')->name('admin.district.delete');
	});

/*
|----------------------------------------------
   admin page Division Route are here
|-----------------------------------------------
*/

	Route::group(['prefix' => 'divisions'], function(){
		Route::get('/manage', 'backend\DivisionController@index')->name('admin.division.manage');
		Route::get('/create', 'backend\DivisionController@create')->name('admin.division.create');
		Route::post('/store', 'backend\DivisionController@store')->name('admin.division.store');
		Route::get('/edit/{id}', 'backend\DivisionController@edit')->name('admin.division.edit');
		Route::post('/update/{id}', 'backend\DivisionController@update')->name('admin.division.update');
		Route::post('/delete/{id}', 'backend\DivisionController@delete')->name('admin.division.delete');
	});

    //Shop Settings route are here

    Route::get('/shop_settings', 'backend\ShopSettingController@setting')->name('admin.shop.setting');

});


