<?php

return array(

    // route prefix
    'prefix' => 'admin',

    //Generic Permissions
    'generic_permission' => array('view','create','update','delete'),

    'site_config' => array(
        'site_name'   => 'Admin',
        'title'       => 'My Admin Panel',
        'description' => 'Laravel 4 Admin Panel'
    ),

    //menu 2 type are available single or dropdown and it must be a route
    'menu' => array(
        'Dashboard' => array('type' => 'single', 'route' => 'admin.home'),
        'Users'     => array('type' => 'dropdown', 'links' => array(
            'Manage Users' => array('route' => 'admin.users.index'),
            'Groups'       => array('route' => 'admin.groups.index'),
            'Permissions'  => array('route' => 'admin.permissions.index')
        )),
    ),

    'views' => array(

        'layout' => 'admin::layouts',

        'dashboard' => 'admin::dashboard.index',
        'login'     => 'admin::dashboard.login',
        'register'  => 'admin::dashboard.register',

        // Users views
        'users_index'      => 'admin::users.index',
        'users_show'       => 'admin::users.show',
        'users_edit'       => 'admin::users.edit',
        'users_create'     => 'admin::users.create',
        'users_permission' => 'admin::users.permission',

        //Groups Views
        'groups_index'      => 'admin::groups.index',
        'groups_create'     => 'admin::groups.create',
        'groups_edit'       => 'admin::groups.edit',
        'groups_permission' => 'admin::groups.permission',

        //Permissions Views
        'permissions_index'  => 'admin::permissions.index',
        'permissions_edit'   => 'admin::permissions.edit',
        'permissions_create' => 'admin::permissions.create',

        //Throttling Views
        'throttle_status' => 'admin::throttle.index',

        //password Views
        'password_forgot'        => 'admin::password.forgot',
        'email_password_forgot'  => 'admin::password.email',
        'password_send'          => 'admin::password.send',
        'password_reset'         => 'admin::password.reset',
    ),

    'validation' => array(
        'user'       => 'Verecom\Admin\Services\Validators\Users\Validator',
        'permission' => 'Verecom\Admin\Services\Validators\Permissions\Validator',
    ),
);
