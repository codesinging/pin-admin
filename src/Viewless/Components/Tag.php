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
 * Class Tag
 *
 * @method static $this make(array|string|Closure|Tag|null $content = null, array|null $type = null, array|null $attributes = null)
 *
 * @method $this type(string $type)
 * @method $this closable(bool $closable = true)
 * @method $this disableTransitions(bool $disableTransitions = true)
 * @method $this hit(bool $hit = true)
 * @method $this color(string $color)
 * @method $this size(string $size)
 * @method $this effect(string $effect)
 *
 * @method $this type_primary()
 * @method $this type_success()
 * @method $this type_info()
 * @method $this type_warning()
 * @method $this type_danger()
 *
 * @method $this size_large()
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this effect_dark()
 * @method $this effect_light()
 * @method $this effect_plain()
 *
 * @method $this onClick(string $handler = null, ...$parameters)
 * @method $this onClose(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Tag extends Component
{
    /**
     * Tag constructor.
     *
     * @param array|string|null $content
     * @param array|string|null $type
     * @param array|null $attributes
     */
    public function __construct($content = null, $type = null, array $attributes = null)
    {
        is_array($content) and [$attributes, $content] = [$content, null];
        is_array($type) and [$attributes, $type] = [$type, null];
        parent::__construct($attributes, $content);
        is_null($type) or $this->set('type', $type);
    }
}