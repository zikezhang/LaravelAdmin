<?php

Route::group(array('prefix' => Config::get('admin::prefix', 'admin')), function()
{
    /*
    |--------------------------------------------------------------------------
    | admin Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('/', array(
        'as'     => 'admin.home',
        'uses'   => 'Verecom\Admin\Controllers\AdminController@index',
        'before' => 'auth.admin:admin.view'
    ));

    /*
    |--------------------------------------------------------------------------
    | admin Permissions Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('permissions', array(
        'as'     => 'admin.permissions.index',
        'uses'   => 'Verecom\Admin\Controllers\PermissionsController@index',
        'before' => 'auth.admin'
    ));
    Route::post('permissions', array(
        'as'     => 'admin.permissions.store',
        'uses'   => 'Verecom\Admin\Controllers\PermissionsController@store',
        'before' => 'auth.admin'
    ));
    Route::get('permissions/create', array(
        'as'     => 'admin.permissions.create',
        'uses'   => 'Verecom\Admin\Controllers\PermissionsController@create',
        'before' => 'auth.admin'
    ));
    Route::get('permissions/{id}/edit', array(
        'as'     => 'admin.permissions.edit',
        'uses'   => 'Verecom\Admin\Controllers\PermissionsController@edit',
        'before' => 'auth.admin'
    ));
    Route::put('permissions/{id}', array(
        'as'     => 'admin.permissions.update',
        'uses'   => 'Verecom\Admin\Controllers\PermissionsController@update',
        'before' => 'auth.admin'
    ));
    Route::delete('permissions/{id}', array(
        'as'     => 'admin.permissions.destroy',
        'uses'   => 'Verecom\Admin\Controllers\PermissionsController@destroy',
        'before' => 'auth.admin'
    ));

    /*
    |--------------------------------------------------------------------------
    | admin Groups Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('groups', array(
        'as'     => 'admin.groups.index',
        'uses'   => 'Verecom\Admin\Controllers\GroupsController@index',
        'before' => 'auth.admin'
    ));
    Route::post('groups', array(
        'as'     => 'admin.groups.store',
        'uses'   => 'Verecom\Admin\Controllers\GroupsController@store',
        'before' => 'auth.admin'
    ));
    Route::get('groups/create', array(
        'as'     => 'admin.groups.create',
        'uses'   => 'Verecom\Admin\Controllers\GroupsController@create',
        'before' => 'auth.admin'
    ));
    Route::get('groups/{id}/edit', array(
        'as'     => 'admin.groups.edit',
        'uses'   => 'Verecom\Admin\Controllers\GroupsController@edit',
        'before' => 'auth.admin'
    ));
    Route::put('groups/{id}', array(
        'as'     => 'admin.groups.update',
        'uses'   => 'Verecom\Admin\Controllers\GroupsController@update',
        'before' => 'auth.admin'
    ));
    Route::delete('groups/{id}', array(
        'as'     => 'admin.groups.destroy',
        'uses'   => 'Verecom\Admin\Controllers\GroupsController@destroy',
        'before' => 'auth.admin'
    ));

    /*
    |--------------------------------------------------------------------------
    | admin Users Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('users', array(
        'as'     => 'admin.users.index',
        'uses'   => 'Verecom\Admin\Controllers\UsersController@index',
        'before' => 'auth.admin'
    ));
    Route::post('users', array(
        'as'     => 'admin.users.store',
        'uses'   => 'Verecom\Admin\Controllers\UsersController@store',
        'before' => 'auth.admin'
    ));
    Route::get('users/create', array(
        'as'     => 'admin.users.create',
        'uses'   => 'Verecom\Admin\Controllers\UsersController@create',
        'before' => 'auth.admin'
    ));
    Route::get('users/{id}', array(
        'as'     => 'admin.users.show',
        'uses'   => 'Verecom\Admin\Controllers\UsersController@show',
        'before' => 'auth.admin'
    ));
    Route::get('users/{id}/edit', array(
        'as'     => 'admin.users.edit',
        'uses'   => 'Verecom\Admin\Controllers\UsersController@edit',
        'before' => 'auth.admin'
    ));
    Route::put('users/{id}', array(
        'as'     => 'admin.users.update',
        'uses'   => 'Verecom\Admin\Controllers\UsersController@update',
        'before' => 'auth.admin'
    ));
    Route::delete('users/{id}', array(
        'as'     => 'admin.users.destroy',
        'uses'   => 'Verecom\Admin\Controllers\UsersController@destroy',
        'before' => 'auth.admin'
    ));
    Route::put('users/{users}/activate', array(
        'as'     => 'admin.users.activate',
        'uses'   => 'Verecom\Admin\Controllers\UsersController@putActivate',
        'before' => 'auth.admin:users.update'
    ));

    Route::put('users/{users}/deactivate', array(
        'as'     => 'admin.users.deactivate',
        'uses'   => 'Verecom\Admin\Controllers\UsersController@putDeactivate',
        'before' => 'auth.admin:users.update'
    ));


    /*
    |--------------------------------------------------------------------------
    | admin Users Permissions Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('users/{users}/permissions', array(
        'as'     => 'admin.users.permissions',
        'uses'   => 'Verecom\Admin\Controllers\UsersPermissionsController@index',
        'before' => 'auth.admin:users.update'
    ));

    Route::put('users/{users}/permissions', array(
        'uses'   => 'Verecom\Admin\Controllers\UsersPermissionsController@update',
        'before' => 'auth.admin:users.update'
    ));

    /*
    |--------------------------------------------------------------------------
    | admin Users Throttling Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('users/{user}/throttling', array(
        'as'     => 'admin.users.throttling',
        'uses'   => 'Verecom\Admin\Controllers\UsersThrottlingController@getStatus',
        'before' => 'auth.admin:users.view'
    ));

    Route::put('users/{user}/throttling/{action}', array(
        'as'     => 'admin.users.throttling.update',
        'uses'   => 'Verecom\Admin\Controllers\UsersThrottlingController@putStatus',
        'before' => 'auth.admin:users.update'
    ));

    /*
    |--------------------------------------------------------------------------
    | admin Login/Logout/Register Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('login', array(
        'as'   => 'admin.login',
        'uses' => 'Verecom\Admin\Controllers\adminController@getLogin'
    ));

    Route::get('logout', array(
        'as'   => 'admin.logout',
        'uses' => 'Verecom\Admin\Controllers\adminController@getLogout'
    ));

    Route::post('login','Verecom\Admin\Controllers\adminController@postLogin');

    Route::get('register', array(
        'as'   => 'admin.register',
        'uses' => 'Verecom\Admin\Controllers\adminController@getRegister'
    ));

    Route::post('register','Verecom\Admin\Controllers\adminController@postRegister');

    /*
    |--------------------------------------------------------------------------
    | admin Password management Routes
    |--------------------------------------------------------------------------
    |
    |
    */
    Route::get('password/forgot', array(
        'as'   => 'admin.password.forgot',
        'uses' => 'Verecom\Admin\Controllers\PasswordController@getForgot'
    ));

    Route::post('password/forgot','Verecom\Admin\Controllers\PasswordController@postForgot');

    Route::get('password/reset/{code}', array(
        'as'   => 'admin.password.reset',
        'uses' => 'Verecom\Admin\Controllers\PasswordController@getReset'
    ));

    Route::post('password/reset',array(
        'as' => 'admin.password.update',
        'uses' => 'Verecom\Admin\Controllers\PasswordController@postReset'
    ));

});




/*
|--------------------------------------------------------------------------
| Admin auth filter
|--------------------------------------------------------------------------
| You need to give your routes a name before using this filter.
| I assume you are using resource. so the route for the UsersController index method
| will be admin.users.index then the filter will look for permission on users.view
| You can provide your own rule by passing a argument to the filter
|
*/
Route::filter('auth.admin', function($route, $request, $userRule = null)
{
    if (! Sentry::check())
    {
        Session::put('url.intended', URL::full());
        return Redirect::route('admin.login');
    }

    // no special route name passed, use the current name route
    if ( is_null($userRule) )
    {
        list($prefix, $module, $rule) = explode('.', Route::currentRouteName());
        switch ($rule)
        {
            case 'index':
            case 'show':
                $userRule = $module.'.view';
                break;
            case 'create':
            case 'store':
                $userRule = $module.'.create';
                break;
            case 'edit':
            case 'update':
                $userRule = $module.'.update';
                break;
            case 'destroy':
                $userRule = $module.'.delete';
                break;
            default:
                $userRule = Route::currentRouteName();
                break;
        }
    }
    // no access to the request page and request page not the root admin page
    if ( ! Sentry::hasAccess($userRule) and $userRule !== 'admin.view' )
    {
        return Redirect::route('admin.home')
            ->with('error', Lang::get('admin::permissions.access_denied'));
    }
    // no access to the request page and request page is the root admin page
    else if( ! Sentry::hasAccess($userRule) and $userRule === 'admin.view' )
    {
        //can't see the admin home page go back to home site page
        return Redirect::to('/')
            ->with('error', Lang::get('admin::permissions.access_denied'));
    }

});
