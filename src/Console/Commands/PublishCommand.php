<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Console\Commands;

use CodeSinging\PinAdmin\Console\OutputHelpers;
use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Foundation\AdminServiceProvider;
use Illuminate\Console\Command;

class PublishCommand extends Command
{
    use OutputHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Admin::NAME . ':publish {group?}';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Publish the PinAdmin resources';

    /**
     * The resources group.
     * @var null|string
     */
    protected $group = null;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->initArguments();
        $this->publishResources();
    }

    /**
     * Initialize the arguments and options.
     */
    private function initArguments(): void
    {
        $this->group = $this->argument('group');
    }

    /**
     * Publish resources.
     */
    private function publishResources(): void
    {
        if (is_null($this->group)){
            $title = 'Publishing all resources...';
            $params = ['--provider' => AdminServiceProvider::class, '--force' => true];
        } else{
            $title = "Publishing {$this->group} resources...";
            $params = ['--tag' => "admin-{$this->group}", '--force' => true];
        }

        $this->title($title);
        $this->call('vendor:publish', $params);
    }
}