<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use CodeSinging\PinAdmin\Console\OutputHelpers;
use Illuminate\Console\Command;

class TestTitleCommand extends Command
{
    use OutputHelpers;

    protected $signature = 'admin-test:title';

    public function handle()
    {
        $this->title('Test title');
    }
}