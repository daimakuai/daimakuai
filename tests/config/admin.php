<?php

return [

    /*
     * Daimakuai name.
     */
    'name'  => 'Daimakuai',

    /*
     * Daimakuai url prefix.
     */
    'prefix'    => 'admin',

    /*
     * Daimakuai install directory.
     */
    'directory' => app_path('Admin'),

    /*
     * Daimakuai title.
     */
    'title'  => 'Admin',

    /*
     * Daimakuai auth setting.
     */
    'auth' => [
        'driver'   => 'session',
        'provider' => '',
        'model'    => Jblv\Admin\Auth\Database\Administrator::class,
    ],

    /*
     * Daimakuai upload setting.
     */
    'upload'  => [

        'disk' => 'admin',

        'directory'  => [
            'image'  => 'image',
            'file'   => 'file',
        ],

        'host' => 'http://localhost:8000/upload/',
    ],

    /*
     * Daimakuai database setting.
     */
    'database' => [
        'users_table' => 'admin_users',
        'users_model' => Jblv\Admin\Auth\Database\Administrator::class,

        'roles_table' => 'admin_roles',
        'roles_model' => Jblv\Admin\Auth\Database\Role::class,

        'permissions_table' => 'admin_permissions',
        'permissions_model' => Jblv\Admin\Auth\Database\Permission::class,

        'menu_table'  => 'admin_menu',
        'menu_model'  => Jblv\Admin\Auth\Database\Menu::class,

        'operation_log_table'    => 'admin_operation_log',
        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table'       => 'admin_role_users',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table'        => 'admin_role_menu',
    ],

    /*
     * By setting this option to open or close operation log in daimakuai.
     */
    'operation_log'   => true,

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
    'skin'    => 'skin-blue',

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

    'version'   => '1.0',
];
