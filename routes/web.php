<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//obtenemos promociones para home
Route::get('/promotions', function () {
	return response()->json(\App\Promotion::all());
});

//obtenemos productos para home
Route::get('/products', function () {
	return response()->json(\App\Product::all());
});

//rutas carrito
Route::group(['prefix' => 'cart'], function () {
	Route::get('/', 'CartController@index');
	Route::post('/add-product', 'CartController@add');
	Route::post('/decrement-product', 'CartController@decrement');
	Route::delete('/remove-product/{id}', 'CartController@remove');
	Route::post('/process', 'CartController@process');
});

//rutas admin
Route::group(['prefix' => 'admin'], function () {
	Route::group(['prefix' => 'products'], function () {
		Route::get('/', 'Admin\ProductsController@index')->name('admin.products');
		Route::get('/data', 'Admin\ProductsController@data')->name('admin.products_data');
		Route::get('/json', 'Admin\ProductsController@json')->name('admin.products_json');
		Route::delete('/{product}', 'Admin\ProductsController@delete')->name('admin.products_delete');
		Route::get('/create', 'Admin\ProductsController@create')->name('admin.products_create');
		Route::post('/store', 'Admin\ProductsController@store')->name('admin.products_store');
	});

	Route::group(['prefix' => 'orders'], function () {
		Route::get('/', 'Admin\OrdersController@index')->name('admin.orders');
		Route::get('/json', 'Admin\OrdersController@json')->name('admin.orders_json');
		Route::get('/{order}', 'Admin\OrdersController@show')->name('admin.order_detail');
		Route::get('/jsonDetail/{order}', 'Admin\OrdersController@jsonDetail')->name('admin.order_json_detail');
	});

	Route::group(['prefix' => 'promotions'], function () {
		Route::get('/', 'Admin\PromotionsController@index')->name('admin.promotions');
		Route::get('/json', 'Admin\PromotionsController@json')->name('admin.promotions_json');
		Route::delete('/{promotion}', 'Admin\PromotionsController@delete')->name('admin.promotions_delete');
		Route::get('/create', 'Admin\PromotionsController@create')->name('admin.promotions_create');
		Route::post('/store', 'Admin\PromotionsController@store')->name('admin.promotions_store');
	});
});

//rutas pedidos clientes
Route::group(['prefix' => 'orders'], function () {
	Route::get('/', 'OrdersController@index')->name('orders');
	Route::get('/json', 'OrdersController@json')->name('orders_json');
	Route::get('/{order}', 'OrdersController@show')->name('order_detail');
	Route::get('/jsonDetail/{order}', 'OrdersController@jsonDetail')->name('order_json_detail');
});

//ruta para actualizar el estadoestado líneas de pedido
Route::put('/order_lines/{id}/status', 'OrderLinesController@updateStatus')->name('order_lines.update_status');
