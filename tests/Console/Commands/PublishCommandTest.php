<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console\Commands;

use CodeSinging\PinAdmin\Facades\Admin;
use CodeSinging\PinAdmin\Tests\GetPackageProviders;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;

class PublishCommandTest extends TestCase
{
    use GetPackageProviders;

    public function testPublishAllResources()
    {
        $this->artisan('admin:publish')->run();

        self::assertFileExists(config_path('admin.php'));
        self::assertFileExists(base_path('routes/admin.php'));
        self::assertDirectoryExists(public_path('static/vendor/' . Admin::name()));
        self::assertDirectoryExists(public_path('static/vendor/' . Admin::name().'/images'));

        File::delete(config_path('admin.php'));
        File::delete(base_path('routes/admin.php'));
        File::deleteDirectory(public_path('static/vendor/'. Admin::name()));
    }

    public function testPublishResources()
    {
        $this->artisan('admin:publish config');
        self::assertFileExists(config_path('admin.php'));
        File::delete(config_path('admin.php'));

        $this->artisan('admin:publish route');
        self::assertFileExists(base_path('routes/admin.php'));
        File::delete(base_path('routes/admin.php'));

        $this->artisan('admin:publish asset');
        self::assertFileExists(public_path('static/vendor/'. Admin::name()));
        File::deleteDirectory(public_path('static/vendor/'. Admin::name()));
    }
}
