<?php

namespace Jblv\Admin\Console;

use Illuminate\Console\Command;
use Jblv\Admin\Facades\Admin;

class MenuCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin:menu';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show the admin menu.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $menu = Admin::menu();

        echo json_encode($menu, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), "\r\n";
    }
}
