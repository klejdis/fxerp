<?php

/**
 * Client Routes
 */

Route::get('/clients', [
    'as'     => 'clients.index',
    'uses'   => 'ClientsController@index',
    'middleware' => 'permission:browse-clients'
]);

Route::post('/clients/datatable', [
    'as'     => 'clients.datatable',
    'uses'   => 'ClientsController@datatable',
    'middleware' => 'permission:browse-clients'
]);

Route::get('/clients/{client}/show', [
    'as'     => 'clients.show',
    'uses'   => 'ClientsController@show',
    'middleware' => 'permission:read-clients'
]);

Route::get('/clients/{client}/show/general-info/tab', [
    'as'     => 'clients.show.general_info_tab',
    'uses'   => 'ClientsController@generalInfoTab',
    'middleware' => 'permission:read-clients'
]);

Route::get('/clients/{client}/show/change-password/tab', [
    'as'     => 'clients.show.change_password',
    'uses'   => 'ClientsController@changePasswordTab',
    'middleware' => 'permission:read-clients'
]);

Route::post('/clients/{client}/show/change-password', [
    'as'     => 'clients.show.change_password.post',
    'uses'   => 'ClientsController@changePassword',
    'middleware' => 'permission:read-clients'
]);

Route::get('/clients/{client}/show/permissions', [
    'as'     => 'clients.show.permission',
    'uses'   => 'ClientsController@permissionsTab',
    'middleware' => 'permission:read-clients'
]);

Route::post('/clients/{client}/show/permissions', [
    'as'     => 'clients.show.permissions.post',
    'uses'   => 'ClientsController@permissionsTabPost',
    'middleware' => 'permission:read-clients'
]);

Route::post('/clients/create', [
    'as'     => 'clients.create',
    'uses'   => 'ClientsController@create',
    'middleware' => 'permission:create-clients'
]);

Route::post('/clients', [
    'as'     => 'clients.store',
    'uses'   => 'ClientsController@store',
    'middleware' => 'permission:create-clients'
]);

Route::post('/clients/{client}/edit', [
    'as'     => 'clients.edit',
    'uses'   => 'ClientsController@edit',
    'middleware' => 'permission:edit-clients'
]);

Route::post('/clients/{client}/quick-update', [
    'as'     => 'clients.quick_update',
    'uses'   => 'ClientsController@quickUpdate',
    'middleware' => 'permission:edit-clients'
]);

Route::post('/clients/{client}', [
    'as'     => 'clients.update',
    'uses'   => 'ClientsController@update',
    'middleware' => 'permission:edit-clients'
]);

Route::post('/clients/destroy/user', [
    'as'     => 'clients.destroy',
    'uses'   => 'ClientsController@delete',
    'middleware' => 'permission:delete-clients'
]);
