<?php

namespace Jblv\Admin\Middleware;

use Illuminate\Http\Request;
use Jblv\Admin\Form;
use Jblv\Admin\Grid;

class Bootstrap
{
    public function handle(Request $request, \Closure $next)
    {
        Form::registerBuiltinFields();

        if (file_exists($bootstrap = admin_path('bootstrap.php'))) {
            require $bootstrap;
        }

        Form::collectFieldAssets();

        Grid::registerColumnDisplayer();

        return $next($request);
    }
}
