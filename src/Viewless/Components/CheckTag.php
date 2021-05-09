<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class CheckTag
 *
 * @method static $this make(array|string|Closure|CheckTag|null $content = null, array|null $attributes = null)
 *
 * @method $this checked(bool $checked = true)
 *
 * @method $this onChange(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class CheckTag extends Component
{
    /**
     * CheckTag constructor.
     *
     * @param array|string|null $content
     * @param array|null $attributes
     */
    public function __construct($content = null, array $attributes = null)
    {
        is_array($content) and [$attributes, $content] = [$content, null];
        parent::__construct($attributes, $content);
    }
}