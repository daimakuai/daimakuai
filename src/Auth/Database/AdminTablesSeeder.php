<?php

namespace Jblv\Admin\Auth\Database;

use Illuminate\Database\Seeder;

class AdminTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Administrator::truncate();
        Administrator::create([
            'username'  => 'admin',
            'password'  => bcrypt('admin'),
            'name'      => 'Administrator',
        ]);

        // create a role.
        Role::truncate();
        Role::create([
            'name'  => 'Administrator',
            'slug'  => 'administrator',
        ]);

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => 'dashboard',
                'icon'      => 'fa-bar-chart',
                'uri'       => '/welcome',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => '管理',
                'icon'      => 'fa-tasks',
                'uri'       => '',
            ],
            [
                'parent_id' => 2,
                'order'     => 3,
                'title'     => '用户',
                'icon'      => 'fa-users',
                'uri'       => 'auth/users',
            ],
            [
                'parent_id' => 2,
                'order'     => 4,
                'title'     => '角色',
                'icon'      => 'fa-user',
                'uri'       => 'auth/roles',
            ],
            [
                'parent_id' => 2,
                'order'     => 5,
                'title'     => '权限',
                'icon'      => 'fa-user',
                'uri'       => 'auth/permissions',
            ],
            [
                'parent_id' => 2,
                'order'     => 6,
                'title'     => '菜单',
                'icon'      => 'fa-bars',
                'uri'       => 'auth/menu',
            ],
            [
                'parent_id' => 2,
                'order'     => 7,
                'title'     => '操作日志',
                'icon'      => 'fa-history',
                'uri'       => 'auth/logs',
            ],
            [
                'parent_id' => 0,
                'order'     => 8,
                'title'     => '助手',
                'icon'      => 'fa-gears',
                'uri'       => '',
            ],
            [
                'parent_id' => 8,
                'order'     => 9,
                'title'     => '脚手架',
                'icon'      => 'fa-keyboard-o',
                'uri'       => 'helpers/scaffold',
            ],
            [
                'parent_id' => 8,
                'order'     => 10,
                'title'     => '数据库命令',
                'icon'      => 'fa-database',
                'uri'       => 'helpers/terminal/database',
            ],
            [
                'parent_id' => 8,
                'order'     => 11,
                'title'     => '脚本命令',
                'icon'      => 'fa-terminal',
                'uri'       => 'helpers/terminal/artisan',
            ],
        ]);

        // add role to menu.
        Menu::find(2)->roles()->save(Role::first());
        Menu::find(8)->roles()->save(Role::first());
    }
}
