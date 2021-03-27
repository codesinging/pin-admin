<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use CodeSinging\PinAdmin\Console\FileHelpers;
use CodeSinging\PinAdmin\Console\PackageHelpers;
use Illuminate\Console\Command;

class TestUpdateNodePackages extends Command
{
    use DirectoryHelpers;
    use FileHelpers;
    use PackageHelpers;

    const SIGNATURE = 'admin-test:update-node-packages';

    protected $signature = 'admin-test:update-node-packages';

    public function handle()
    {
        $this->updateNodePackages(function ($packages, $dev) {
            return [
                    "element-ui" => '^2.0.0'
                ] + $packages;
        }, false);
    }
}