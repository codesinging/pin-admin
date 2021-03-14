<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use CodeSinging\PinAdmin\Console\FileHelpers;
use Illuminate\Console\Command;

class TestCopyFilesCommand extends Command
{
    use DirectoryHelpers;
    use FileHelpers;

    const SIGNATURE = 'admin-test:copy-files';

    protected $signature = 'admin-test:copy-files';

    public function handle()
    {
        $this->copyFiles(
            $this->stubPath(),
            $this->distPath(),
            [
                '__CONTENT__' => 'content'
            ],
            [
                '__ID__' => '1'
            ]
        );
    }
}