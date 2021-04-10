<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Console\Commands;

use CodeSinging\PinAdmin\Console\FileHelpers;
use CodeSinging\PinAdmin\Console\OutputHelpers;
use CodeSinging\PinAdmin\Console\PackageHelpers;
use CodeSinging\PinAdmin\Database\Seeders\AdminMenuSeeder;
use CodeSinging\PinAdmin\Database\Seeders\AdminUserSeeder;
use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Foundation\AdminServiceProvider;
use Illuminate\Console\Command;
use Mews\Captcha\CaptchaServiceProvider;

class InstallCommand extends Command
{
    use OutputHelpers;
    use FileHelpers;
    use PackageHelpers;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = Admin::NAME . ':install';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Install the PinAdmin application';

    /**
     * @var array
     */
    protected $publishProviders = [
        AdminServiceProvider::class,
        CaptchaServiceProvider::class,
    ];

    /**
     * @var array
     */
    protected $databaseSeeders = [
        AdminUserSeeder::class,
        AdminMenuSeeder::class,
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->createDirectories();
        $this->updatePackages();
        $this->publishResources();
        $this->migrateDatabase();
        $this->seedDatabase();
    }

    /**
     * Create application directories.
     */
    private function createDirectories(): void
    {
        $this->title('Creating directories...');

        $this->makeDirectory(Admin::app()->path());
        $this->makeDirectory(resource_path(Admin::app()->name()));
    }

    /**
     * Update node packages.
     */
    private function updatePackages(): void
    {
        $this->title('Updating node packages...');
        $this->addNodePackages([
            "axios" => "^0.21.1",
            "blueimp-md5" => "^2.18.0",
            "bootstrap-icons" => "^1.4.0",
            "element-plus" => "^1.0.2-beta.35",
            "particles.js" => "^2.0.0",
            "screenfull" => "^5.1.0",
            "tailwindcss" => "^2.0.4",
            "vue" => "^3.0.7",
        ], false);

        $this->addNodePackages([
            "@vue/compiler-sfc" => "^3.0.7",
            "autoprefixer" => "^10.2.5",
            "laravel-mix" => "^6.0.13",
            "postcss" => "^8.1",
            "vue-loader" => "^16.1.0",
        ], true);
    }

    /**
     * Publish resources.
     */
    private function publishResources(): void
    {
        $this->title('Publishing resources...');

        foreach ($this->publishProviders as $provider) {
            $this->call('vendor:publish', ['--provider' => $provider, '--force' => true]);
        }
    }

    /**
     * Migrate database.
     */
    private function migrateDatabase(): void
    {
        $this->title('Migrating database...');

        $this->call('migrate');
    }

    /**
     * Seed database.
     */
    private function seedDatabase(): void
    {
        $this->title('Seeding database...');

        foreach ($this->databaseSeeders as $seeder) {
            $this->call('db:seed', ['--class' => $seeder]);
        }
    }
}