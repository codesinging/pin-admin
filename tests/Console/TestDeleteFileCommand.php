<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use CodeSinging\PinAdmin\Console\FileHelpers;
use Illuminate\Console\Command;

class TestDeleteFileCommand extends Command
{
    use FileHelpers;
    use DirectoryHelpers;

    const SIGNATURE = 'admin-test:delete-file';

    protected $signature = 'admin-test:delete-file';

    public function handle()
    {
        $this->deleteFile($this->distPath('stub.php'));
    }
}