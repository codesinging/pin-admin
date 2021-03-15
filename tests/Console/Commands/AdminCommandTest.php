<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console\Commands;

use CodeSinging\PinAdmin\Console\Commands\AdminCommand;
use CodeSinging\PinAdmin\Tests\GetPackageProviders;
use Orchestra\Testbench\TestCase;

class AdminCommandTest extends TestCase
{
    use GetPackageProviders;

    public function testCommand()
    {
        $artisan = $this->artisan('admin');
        $artisan->assertExitCode(0);
    }
}
