<?php

namespace Jblv\Admin\Facades;

use Illuminate\Support\Facades\Facade;

class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Jblv\Admin\Admin::class;
    }
}
