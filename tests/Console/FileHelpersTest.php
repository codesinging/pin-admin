<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Console;

use CodeSinging\PinAdmin\Console\FileHelpers;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;

class FileHelpersTest extends TestCase
{
    use RegisterCommand;
    use FileHelpers;
    use DirectoryHelpers;

    protected function tearDown(): void
    {
        parent::tearDown();
        File::deleteDirectory($this->distPath());
    }

    public function testMakeDirectory()
    {
        self::assertDirectoryDoesNotExist($this->distPath());

        $this->registerCommand(TestMakeDirectoryCommand::class);

        $this->artisan(TestMakeDirectoryCommand::SIGNATURE)->run();
        self::assertDirectoryExists($this->distPath());
    }

    public function testCopyFile()
    {
        self::assertFileDoesNotExist($this->distPath('stub.php'));
        $this->registerCommand(TestCopyFileCommand::class);

        $this->artisan(TestCopyFileCommand::class)->run();

        self::assertFileExists($this->distPath('stub.php'));
        self::assertStringEqualsFile($this->distPath('stub.php'), 'content');
    }

    public function testCopyFiles()
    {
        self::assertFileDoesNotExist($this->distPath('stub.php'));
        self::assertFileDoesNotExist($this->distPath('stub-1.php'));

        $this->registerCommand(TestCopyFilesCommand::class);

        $this->artisan(TestCopyFilesCommand::SIGNATURE)->run();

        self::assertFileExists($this->distPath('stub.php'));
        self::assertStringEqualsFile($this->distPath('stub.php'), 'content');

        self::assertFileExists($this->distPath('stub-1.php'));
        self::assertStringEqualsFile($this->distPath('stub-1.php'), 'content');
    }

    public function testDeleteDirectory()
    {
        File::makeDirectory($this->distPath());
        File::copy($this->stubPath('stub.php'), $this->distPath('stub.php'));

        self::assertDirectoryExists($this->distPath());

        $this->registerCommand(TestDeleteDirectoryCommand::class);

        $this->artisan(TestDeleteDirectoryCommand::SIGNATURE)->run();

        self::assertDirectoryDoesNotExist($this->distPath());
    }

    public function testDeleteFile()
    {
        File::makeDirectory($this->distPath());
        File::copy($this->stubPath('stub.php'), $this->distPath('stub.php'));

        self::assertFileExists($this->distPath('stub.php'));

        $this->registerCommand(TestDeleteFileCommand::class);

        $this->artisan(TestDeleteFileCommand::SIGNATURE)->run();

        self::assertFileDoesNotExist($this->distPath('stub.php'));
    }
}
