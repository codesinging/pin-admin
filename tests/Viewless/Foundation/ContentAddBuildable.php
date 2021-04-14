<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Viewless\Foundation;

use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;

class ContentAddBuildable extends Buildable
{
    protected $content;

    public function __construct(string $content = null)
    {
        $this->content = $content;
    }

    /**
     * @inheritDoc
     */
    public function build(): string
    {
        return $this->content;
    }
}