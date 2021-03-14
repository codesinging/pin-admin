<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use CodeSinging\PinAdmin\Console\FileHelpers;
use Illuminate\Console\Command;

class TestMakeDirectoryCommand extends Command
{
    use FileHelpers;
    use DirectoryHelpers;

    const SIGNATURE = 'admin-test:make-directory';

    protected $signature = 'admin-test:make-directory';

    public function handle()
    {
        $this->makeDirectory($this->distPath());
    }
}