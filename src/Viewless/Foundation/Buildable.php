<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Foundation;

abstract class Buildable
{
    /**
     * Build content as a string of the object.
     *
     * @return string
     */
    abstract public function build(): string;

    /**
     * Get the content as a string of the object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->build();
    }
}