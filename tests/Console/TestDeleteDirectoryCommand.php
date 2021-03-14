<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use CodeSinging\PinAdmin\Console\FileHelpers;
use Illuminate\Console\Command;

class TestDeleteDirectoryCommand extends Command
{
    use DirectoryHelpers;
    use FileHelpers;

    const SIGNATURE = 'admin-test:delete-directory';

    protected $signature = 'admin-test:delete-directory';

    public function handle()
    {
        $this->deleteDirectory($this->distPath());
    }
}