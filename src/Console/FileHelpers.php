<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Console;

use Illuminate\Support\Facades\File;

trait FileHelpers
{
    /**
     * Create a directory.
     * @param string $path
     */
    protected function makeDirectory(string $path)
    {
        if (File::isDirectory($path)) {
            $this->warn(sprintf('Directory existed [%s]', $path));
        } else {
            if (File::makeDirectory($path, 0755, true)) {
                $this->info(sprintf('Created directory [%s]', $path));
            } else {
                $this->error('Failed to create directory [%s]', $path);
            }
        }
    }

    /**
     * Copy a file.
     * @param string $srcFilename
     * @param string $destFilename
     * @param array $replaces
     */
    protected function copyFile(string $srcFilename, string $destFilename, array $replaces = [])
    {
        if (File::isFile($srcFilename)) {
            $content = File::get($srcFilename);

            foreach ($replaces as $search => $replace) {
                $content = str_replace($search, $replace, $content);
            }

            if (!File::isDirectory(dirname($destFilename))) {
                $this->makeDirectory(dirname($destFilename));
            }

            if (File::put($destFilename, $content)) {
                $this->info(sprintf('Created file [%s]', $destFilename));
            } else {
                $this->error(sprintf('Failed to create file [%s]', $destFilename));
            }
        } else {
            $this->warn(sprintf('File not found [%s]', $srcFilename));
        }
    }

    /**
     * Copy all files of a directory.
     * @param string $srcDirectory
     * @param string $destDirectory
     * @param array $replaces
     * @param array $filenameReplaces
     */
    protected function copyFiles(string $srcDirectory, string $destDirectory, array $replaces = [], array $filenameReplaces = [])
    {
        if (File::isDirectory($srcDirectory)) {
            $files = File::files($srcDirectory);
            foreach ($files as $file) {
                $filename = $file->getFilename();
                if ($filenameReplaces){
                    foreach ($filenameReplaces as $search => $replace) {
                        $filename = str_replace($search, $replace, $filename);
                    }
                }
                $this->copyFile($file->getPathname(), $destDirectory . DIRECTORY_SEPARATOR . $filename, $replaces);
            }
        } else {
            $this->warn(sprintf('Directory not found [%s]', $srcDirectory));
        }
    }

    /**
     * Delete a directory.
     * @param string $path
     */
    protected function deleteDirectory(string $path)
    {
        if (File::deleteDirectory($path)) {
            $this->info(sprintf('Deleted directory [%s]', $path));
        } else {
            $this->error('Failed to delete directory [%s]', $path);
        }
    }

    /**
     * Delete a file.
     * @param string $path
     */
    protected function deleteFile(string $path)
    {
        if (File::delete($path)) {
            $this->info(sprintf('Deleted file [%s]', $path));
        } else {
            $this->error('Failed to delete file [%s]', $path);
        }
    }
}