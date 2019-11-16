<?php

	Route::group([
	    'namespace' => 'Backend',
	    'prefix' => 'admin',
	    'middleware' => 'auth'
	], function (){
	    // Trang dashboard - trang chủ admin
	    Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
	    // Quản lý sản phẩm
	    Route::group(['prefix' => 'products'], function(){
	       Route::get('/', 'ProductController@index')->name('backend.product.index');
	       Route::get('/show/{id?}', 'ProductController@show')->name('backend.product.show');
	       Route::get('/create', 'ProductController@create')->name('backend.product.create');
	       Route::post('/', 'ProductController@store')->name('backend.product.store');
	       Route::get('/edit/{id}', 'ProductController@edit')->name('backend.product.edit');
	       Route::post('/{id}', 'ProductController@update')->name('backend.product.update');
	       Route::delete('/destroy/{id}', 'ProductController@destroy')->name('backend.product.destroy');
	    });
	    //Quản lý người dùng
	    Route::group(['prefix' => 'users'], function(){
	        Route::get('/', 'UserController@index')->name('backend.user.index');
	        Route::get('/show/{id?}', 'UserController@show')->name('backend.user.show');
	        Route::get('/create', 'UserController@create')->name('backend.user.create');
	        Route::post('/', 'UserController@store')->name('backend.user.store');
	        Route::get('/edit/{id}', 'UserController@edit')->name('backend.user.edit');
	       	Route::put('/{id}', 'UserController@update')->name('backend.user.update');
	       	Route::delete('/destroy/{id}', 'UserController@destroy')->name('backend.user.destroy');
	    });
	    //Quản lý danh mục sản phẩm
	    Route::group(['prefix' => 'categories'], function(){
	        Route::get('/', 'CategoryController@index')->name('backend.categories.index');
	        Route::get('/show/{id?}', 'CategoryController@show')->name('backend.categories.show');
	        Route::get('/create', 'CategoryController@create')->name('backend.categories.create');
	        Route::post('/', 'CategoryController@store')->name('backend.categories.store');
	        Route::get('/edit/{id}', 'CategoryController@edit')->name('backend.categories.edit');
	        Route::post('/{id}', 'CategoryController@update')->name('backend.categories.update');
	        Route::delete('/destroy/{id}', 'CategoryController@destroy')->name('backend.categories.destroy');
	    });
	});

//	Route::get('/upload_file', 'UploadFileController@index');
//	Route::get('/upload_file', 'UploadFileController@upload');
	Route::get('Session/set', 'Backend\SessionController@set');
	Route::get('Session/get', 'Backend\SessionController@get');
	Route::get('Session/get2', 'Backend\SessionController@get2');

    Route::get('Cookie/set', 'Backend\CookieController@set');
    Route::get('Cookie/get', 'Backend\CookieController@get');

    Route::get('/cache', 'HomeController@index');
    Route::get('/getcache', 'HomeController@getcache');

    // login-register
    Route::get('login', 'Auth\LoginController@login')->name('login');
    Route::get('register', 'Auth\RegisterController@register')->name('register');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

	Route::group([
	    'namespace' => 'Frontend',
        'prefix' => 'online'
	], function (){
	    Route::get('/index', 'IndexController@index')->name('frontend.index');
	    Route::group(['prefix' => 'products'], function(){
	       Route::get('/', 'ProductController@index')->name('frontend.products.index');
	       Route::get('/show/{id}', 'ProductController@show')->name('frontend.products.show');
	    });
	    Route::group(['prefix' => 'shop'], function(){
	        Route::get('/', 'ShopController@index')->name('frontend.shop.index');
	    });
	    //Quản lý gio hang
	    Route::group(['prefix' => 'cart'], function(){
	        Route::get('/', 'CartController@index')->name('frontend.cart.index');
	        Route::get('/add/{id}', 'CartController@add2Cart')->name('frontend.cart.add');
	        Route::delete('/destroy/{id}', 'CartController@destroy')->name('frontend.cart.destroy');
	    });
	    Route::group(['prefix' => 'pay'], function(){
	        Route::get('/', 'CartController@pay')->name('frontend.cart.pay');
	        Route::get('/create', 'CartController@create')->name('frontend.cart.create');
	        Route::post('/', 'CartController@store')->name('frontend.cart.store');
	    });
	    Route::group(['prefix' => 'contact'], function(){
	        Route::get('/', 'ContactController@index')->name('frontend.contact.index');
	    });
	});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
