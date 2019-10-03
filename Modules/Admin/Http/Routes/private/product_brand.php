<?php

Route::get('/products-brand', [
    'as'     => 'products-brand.index',
    'uses'   => 'ProductBrandController@index',
    'middleware' => 'permission:browse-product-brand'
]);

Route::post('/products-brand/datatable', [
    'as'     => 'products-brand.datatable',
    'uses'   => 'ProductBrandController@datatable',
    'middleware' => 'permission:browse-product-brand'
]);

Route::get('/products-brand/{productBrand}/show', [
    'as'     => 'products-brand.show',
    'uses'   => 'ProductBrandController@show',
    'module' => 'Roles',
    'middleware' => 'permission:read-product-brand'
]);

Route::post('/products-brand/quick-create', [
    'as'     => 'products-brand.quick_create',
    'uses'   => 'ProductBrandController@quickCreate',
    'middleware' => 'permission:create-product-brand'
]);

Route::post('/products-brand', [
    'as'     => 'products-brand.store',
    'uses'   => 'ProductBrandController@store',
    'middleware' => 'permission:create-product-brand'
]);

Route::post('/products-brand/{productBrand}/edit', [
    'as'     => 'products-brand.edit',
    'uses'   => 'ProductBrandController@edit',
    'middleware' => 'permission:edit-product-brand'
]);

Route::post('/products-brand/{productBrand}/update', [
    'as'     => 'products-brand.update',
    'uses'   => 'ProductBrandController@update',
    'middleware' => 'permission:edit-product-brand'
]);

Route::post('/products-brand/{productBrand}', [
    'as'     => 'products-brand.destroy',
    'uses'   => 'ProductBrandController@delete',
    'middleware' => 'permission:delete-product-brand'
]);
