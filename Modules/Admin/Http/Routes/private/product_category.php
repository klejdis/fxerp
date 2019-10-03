<?php

Route::get('/products-category', [
    'as'     => 'products-category.index',
    'uses'   => 'ProductCategoryController@index',
    'middleware' => 'permission:browse-product-category'
]);

Route::post('/products-category/datatable', [
    'as'     => 'products-category.datatable',
    'uses'   => 'ProductCategoryController@datatable',
    'middleware' => 'permission:browse-product-category'
]);

Route::post('/products-category/quick-create', [
    'as'     => 'products-category.quick_create',
    'uses'   => 'ProductCategoryController@quickCreate',
    'middleware' => 'permission:create-product-category'
]);

Route::post('/products-category', [
    'as'     => 'products-category.store',
    'uses'   => 'ProductCategoryController@store',
    'middleware' => 'permission:create-product-category'
]);

Route::post('/products-category/{productCategory}/edit', [
    'as'     => 'products-category.edit',
    'uses'   => 'ProductCategoryController@edit',
    'middleware' => 'permission:edit-product-category'
]);

Route::post('/products-category/{productCategory}/update', [
    'as'     => 'products-category.update',
    'uses'   => 'ProductCategoryController@update',
    'middleware' => 'permission:edit-product-category'
]);

Route::post('/products-category/{productCategory}', [
    'as'     => 'products-category.destroy',
    'uses'   => 'ProductCategoryController@delete',
    'middleware' => 'permission:delete-product-category'
]);
