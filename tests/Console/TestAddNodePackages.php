<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use CodeSinging\PinAdmin\Console\FileHelpers;
use CodeSinging\PinAdmin\Console\PackageHelpers;
use Illuminate\Console\Command;

class TestAddNodePackages extends Command
{
    use DirectoryHelpers;
    use FileHelpers;
    use PackageHelpers;

    const SIGNATURE = 'admin-test:add-node-packages';

    protected $signature = 'admin-test:add-node-packages';

    public function handle()
    {
        $this->addNodePackages([
            "element-ui" => '^3.0.0'
        ]);
    }
}