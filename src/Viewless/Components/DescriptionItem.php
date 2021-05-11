<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class DescriptionItem
 *
 * @method static $this make(array|string|DescriptionItem|Closure|null $label = null, array|string|null $content = null, array $attributes = null, bool $linebreak = null)
 *
 * @method $this label(string $label)
 * @method $this span(int $span)
 *
 * @method $this slotLabel($contents, string $props = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class DescriptionItem extends Component
{
    /**
     * DescriptionItem constructor.
     *
     * @param array|string|null $label
     * @param array|string|null $content
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($label = null, $content = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($label) and [$attributes, $label] = [$label, null];
        is_array($content) and [$attributes, $content] = [$content, null];
        parent::__construct($attributes, $content, $linebreak);
        is_null($label) or $this->set('label', $label);
    }
}