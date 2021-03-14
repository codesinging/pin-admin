<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use Orchestra\Testbench\TestCase;

class OutputHelpersTest extends TestCase
{
    use RegisterCommand;

    public function testTitle()
    {
        $this->registerCommand(TestTitleCommand::class);

        $artisan = $this->artisan('admin-test:title');
        $artisan->assertExitCode(0);
        $artisan->expectsOutput('- Test title');
    }
}
