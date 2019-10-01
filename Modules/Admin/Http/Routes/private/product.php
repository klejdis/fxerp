<?php

Route::get('/products', [
    'as'     => 'products.index',
    'uses'   => 'ProductsController@index',
    'middleware' => 'permission:browse-product'
]);

Route::post('/products/datatable', [
    'as'     => 'products.datatable',
    'uses'   => 'ProductsController@datatable',
    'middleware' => 'permission:browse-product'
]);

Route::get('/products/{product}/show', [
    'as'     => 'products.show',
    'uses'   => 'ProductsController@show',
    'module' => 'Roles',
    'middleware' => 'permission:read-product'
]);

Route::get('/products/{product}/show/general-info/tab', [
    'as'     => 'products.show.general_info_tab',
    'uses'   => 'ProductsController@generalInfoTab',
    'middleware' => 'permission:read-product'
]);
Route::post('/products/quick-create', [
    'as'     => 'products.quick_create',
    'uses'   => 'ProductsController@quickCreate',
    'middleware' => 'permission:create-product'
]);

Route::post('/products', [
    'as'     => 'products.store',
    'uses'   => 'ProductsController@store',
    'middleware' => 'permission:create-product'
]);

Route::post('/products/{product}/edit', [
    'as'     => 'products.edit',
    'uses'   => 'ProductsController@edit',
    'middleware' => 'permission:edit-product'
]);

Route::post('/products/{product}/update', [
    'as'     => 'products.update',
    'uses'   => 'ProductsController@update',
    'middleware' => 'permission:edit-product'
]);

Route::post('/products/{product}', [
    'as'     => 'products.destroy',
    'uses'   => 'ProductsController@delete',
    'middleware' => 'permission:delete-product'
]);
