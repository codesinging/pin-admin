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
 * Class CheckboxButton
 *
 * @method $this label(string|int|boolean $label)
 * @method $this trueLabel(string|int $trueLabel)
 * @method $this falseLabel(string|int $trueLabel)
 * @method $this disabled(bool $disabled = true)
 * @method $this name(string $name)
 * @method $this checked(bool $checked = true)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class CheckboxButton extends Component
{
    /**
     * CheckboxButton constructor.
     *
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     */
    public function __construct($label = null, $content = null, array $attributes = null)
    {
        is_array($label) and [$attributes, $label] = [$label, null];
        is_array($content) and [$attributes, $content] = [$content, null];
        parent::__construct($attributes, $content);
        is_null($label) or $this->vModel($label);
    }

    /**
     * Make a CheckboxButton instance.
     *
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return self
     */
    public static function make($label = null, $content = null, array $attributes = null): self
    {
        if ($label instanceof Closure) {
            $label = call_closure($label, new static());
        }

        return $label instanceof self ? $label : new static($label, $content, $attributes);
    }
}