<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use CodeSinging\PinAdmin\Console\FileHelpers;
use CodeSinging\PinAdmin\Console\OutputHelpers;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;

class PackageHelpersTest extends TestCase
{
    use DirectoryHelpers;
    use FileHelpers;
    use OutputHelpers;
    use RegisterCommand;

    protected function setUp(): void
    {
        parent::setUp();
        if (is_file(base_path('package.json'))){
            File::move(base_path('package.json'), base_path('package.test.bak.json'));
        }
        File::copy($this->stubPath('package.json'), base_path('package.json'));
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        File::delete(base_path('package.json'));
        if (is_file(base_path('package.test.bak.json'))){
            File::move(base_path('package.test.bak.json'), base_path('package.json'));
        }
    }

    public function testUpdateNodePackages()
    {
        $this->registerCommand(TestUpdateNodePackages::class);

        $command = $this->artisan(TestUpdateNodePackages::SIGNATURE)->run();

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        self::assertEquals([
            "element-ui" => '^2.0.0',
            "vue" => '^3.0.0'
        ], $packages['dependencies']);
    }

    public function testAddNodePackages()
    {
        $this->registerCommand(TestAddNodePackages::class);

        $command = $this->artisan(TestAddNodePackages::SIGNATURE)->run();

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        self::assertEquals([
            "element-ui" => '^3.0.0',
        ], $packages['devDependencies']);
    }
}
