<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Builders;

use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;

class Builder extends Buildable
{
    /**
     * The builder's base tag.
     *
     * @var string
     */
    protected $baseTag = '';

    /**
     * The builder tag's prefix.
     *
     * @var string
     */
    protected $tagPrefix = '';

    /**
     * If the builder has a closing tag.
     *
     * @var bool
     */
    protected $closing = true;

    /**
     * If the builder has linebreak between the opening tag, content and the closing tag.
     *
     * @var bool
     */
    protected $linebreak = false;


}