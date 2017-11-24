<?php

return [
    /*
     * Dai Ma Kuai name.
     */
    'name'      => 'Daimakuai',

    /*
     * Logo in admin panel header.
     */
    'logo'      => '<b>DaiMaKuai</b> ©',

    /*
     * Mini-logo in admin panel header.
     */
    'logo-mini' => '<b>Dmk</b>',

    /*
     * Daimakuai url prefix.
     */
    'route' => [
        'prefix' => 'admin',

        'namespace' => 'App\\Admin\\Controllers',

        'middleware' => ['web', 'admin'],
    ],

    /*
     * Daimakuai install directory.
     */
    'directory' => app_path('Admin'),

    /*
     * Daimakuai html title.
     */
    'title' => 'Admin',

    /**
     * Use `https`.
     */
    'secure' => false,

    /*
     * Daimakuai auth setting.
     */
    'auth' => [
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin',
            ]
        ],

        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model' => Jblv\Admin\Auth\Database\Administrator::class,
            ],
        ],
    ],

    /*
     * Daimakuai upload setting.
     */
    'upload' => [
        'disk' => 'admin',

        'directory' => [
            'image' => 'image',
            'file' => 'file',
        ],

        'host' => 'http://localhost:8000/upload/',
    ],

    /*
     * Daimakuai database setting.
     */
    'database' => [
        // Database connection for following tables.
        'connection' => '',

        // User tables and model.
        'users_table' => 'admin_users',
        'users_model' => Jblv\Admin\Auth\Database\Administrator::class,

        // Role table and model.
        'roles_table' => 'admin_roles',
        'roles_model' => Jblv\Admin\Auth\Database\Role::class,

        // Permission table and model.
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Jblv\Admin\Auth\Database\Permission::class,

        // Menu table and model.
        'menu_table' => 'admin_menu',
        'menu_model' => Jblv\Admin\Auth\Database\Menu::class,

        // Pivot table for table above.
        'operation_log_table' => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table' => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table' => 'admin_role_menu',
    ],

    /*
     * By setting this option to open or close operation log in daimakuai.
     */
    'operation_log' => [
        'enable' => true,

        /**
         * Routes that will not log to database.
         *
         * All method to path like: admin/auth/logs
         * or specific method to path like: get:admin/auth/logs
         */
        'except' => [
            'admin/auth/logs*',
        ]
    ],

    /*
    |---------------------------------------------------------|
    | SKINS         | skin-blue                               |
    |               | skin-black                              |
    |               | skin-purple                             |
    |               | skin-yellow                             |
    |               | skin-red                                |
    |               | skin-green                              |
    |---------------------------------------------------------|
     */
    'skin' => 'skin-blue-light',

    /*
    |---------------------------------------------------------|
    |LAYOUT OPTIONS | fixed                                   |
    |               | layout-boxed                            |
    |               | layout-top-nav                          |
    |               | sidebar-collapse                        |
    |               | sidebar-mini                            |
    |---------------------------------------------------------|
     */
    'layout'  => ['sidebar-mini'],

    /*
     * Version displayed in footer.
     */
    'version'   => '1.2.0',


    'extensions' => [

        'media-manager' => [
            'disk' => 'uploads'
        ],

        'api-tester' => [
            'prefix' => 'api',

            'guard'  => 'api',

            'user_retriever' => function ($id) {
                return \App\User::find($id);
            },
        ]
    ]
];
