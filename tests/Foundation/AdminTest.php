<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Foundation;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Tests\GetPackageProviders;
use Orchestra\Testbench\TestCase;

class AdminTest extends TestCase
{
    use GetPackageProviders;

    public function testApp()
    {
        self::assertInstanceOf(Admin::class, Admin::app());
        self::assertSame(Admin::app(), Admin::app());
    }

    public function testVersion()
    {
        self::assertEquals(Admin::VERSION, (new Admin())->version());
    }

    public function testBrand()
    {
        self::assertEquals(Admin::BRAND, (new Admin())->brand());
    }

    public function testSlogan()
    {
        self::assertEquals(Admin::SLOGAN, (new Admin())->slogan());
    }

    public function testName()
    {
        self::assertEquals(Admin::NAME, (new Admin())->name());
    }

    public function testGuard()
    {
        self::assertEquals(Admin::GUARD, (new Admin())->guard());
    }

    public function testPackagePath()
    {
        self::assertEquals(dirname(dirname(__DIR__)), (new Admin())->packagePath());
        self::assertEquals(dirname(__DIR__), (new Admin())->packagePath('tests'));
    }

    public function testDirectory()
    {
        self::assertEquals(Admin::DIRECTORY, (new Admin())->directory());
        self::assertEquals(Admin::DIRECTORY . DIRECTORY_SEPARATOR . 'Models', (new Admin())->directory('Models'));
    }

    public function testPath()
    {
        self::assertEquals(app_path(Admin::DIRECTORY), (new Admin())->path());
        self::assertEquals(app_path(Admin::DIRECTORY . DIRECTORY_SEPARATOR . 'Models'), (new Admin())->path('Models'));
    }

    public function testGetNamespace()
    {
        self::assertEquals('App\\PinAdmin', (new Admin())->getNamespace());
        self::assertEquals('App\\PinAdmin\\Models', (new Admin())->getNamespace('Models'));
    }
}
