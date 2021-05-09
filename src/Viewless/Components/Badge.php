<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Badge
 *
 * @method static $this make(array|string|int|Badge|Closure|null $value = null, array|string|Buildable|Closure|null $content = null, array $attributes = null, bool $linebreak = null)
 *
 * @method $this value(string|int $value)
 * @method $this max(int $max)
 * @method $this isDot(bool $isDot = true)
 * @method $this hidden(bool $hidden = true)
 * @method $this type(string $type)
 *
 * @method $this type_primary()
 * @method $this type_success()
 * @method $this type_warning()
 * @method $this type_danger()
 * @method $this type_info()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Badge extends Component
{
    /**
     * Badge constructor.
     *
     * @param array|string|int|null $value
     * @param array|string|Buildable|Closure|null $content
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($value = null, $content = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($value) and [$attributes, $value] = [$value, null];
        is_array($content) and [$attributes, $content] = [$content, null];
        parent::__construct($attributes, $content, $linebreak);
        is_null($value) or $this->set('value', $value);
    }
}