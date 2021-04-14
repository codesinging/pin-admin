<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;

class BuildableBuild extends Buildable
{
    const VALUE = 'example';

    /**
     * @return string
     */
    public function build(): string
    {
        return self::VALUE;
    }
}