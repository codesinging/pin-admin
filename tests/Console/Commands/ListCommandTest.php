<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console\Commands;

use CodeSinging\PinAdmin\Console\Commands\ListCommand;
use CodeSinging\PinAdmin\Tests\GetPackageProviders;
use Orchestra\Testbench\TestCase;

class ListCommandTest extends TestCase
{
    use GetPackageProviders;

    public function testCommand()
    {
        $artisan = $this->artisan('admin:list');
        $artisan->assertExitCode(0);
    }
}
