<?php

namespace Jblv\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $commands = [
        'Jblv\Admin\Console\MakeCommand',
        'Jblv\Admin\Console\MenuCommand',
        'Jblv\Admin\Console\InstallCommand',
        'Jblv\Admin\Console\UninstallCommand',
        'Jblv\Admin\Console\ImportCommand',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'admin.auth'       => \Jblv\Admin\Middleware\Authenticate::class,
        'admin.pjax'       => \Jblv\Admin\Middleware\Pjax::class,
        'admin.log'        => \Jblv\Admin\Middleware\LogOperation::class,
        'admin.permission' => \Jblv\Admin\Middleware\Permission::class,
        'admin.bootstrap'  => \Jblv\Admin\Middleware\Bootstrap::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'admin' => [
            'admin.auth',
            'admin.pjax',
            'admin.log',
            'admin.bootstrap',
            'admin.permission',
        ],
    ];

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'admin');

        if (file_exists($routes = admin_path('routes.php'))) {
            $this->loadRoutesFrom($routes);
        }

        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'daimakuai-admin-config');
            $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang')], 'daimakuai-admin-lang');
//            $this->publishes([__DIR__.'/../resources/views' => resource_path('views/admin')],           'daimakuai-admin-views');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'daimakuai-admin-migrations');
            $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/daimakuai-admin')], 'daimakuai-admin-assets');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->loadAdminAuthConfig();

        $this->registerRouteMiddleware();

        $this->commands($this->commands);
    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadAdminAuthConfig()
    {
        config(array_dot(config('admin.auth', []), 'auth.'));
    }

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // register middleware group.
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }
}
