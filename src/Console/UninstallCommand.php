<?php

namespace Jblv\Admin\Console;

use Illuminate\Console\Command;

class UninstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'admin:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall the admin package';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (!$this->confirm('Are you sure to uninstall daimakuai?')) {
            return;
        }

        $this->removeFilesAndDirectories();

        $this->line('<info>Uninstalling daimakuai!</info>');
    }

    /**
     * Remove files and directories.
     */
    protected function removeFilesAndDirectories()
    {
        $this->laravel['files']->deleteDirectory(config('admin.directory'));
        $this->laravel['files']->deleteDirectory(public_path('packages/admin/'));
        $this->laravel['files']->delete(config_path('admin.php'));
    }
}
