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
 * Class Card
 *
 * @method $this header(string $header)
 * @method $this bodyStyle(array $bodyStyle)
 * @method $this shadow(string $shadow)
 *
 * @method $this shadow_always()
 * @method $this shadow_hover()
 * @method $this shadow_never()
 *
 * @method $this slotHeader($contents, string $props = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Card extends Component
{
    /**
     * Card constructor.
     *
     * @param array|string|null $header
     * @param array|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct($header = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        is_array($header) and [$attributes, $header] = [$header, null];

        parent::__construct($attributes, $content, $linebreak);

        is_null($header) or $this->set('header', $header);
    }

    /**
     * Make a Card instance.
     *
     * @param array|string|null $header
     * @param array|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $linebreak
     *
     * @return self
     */
    public static function make($header = null, array $attributes = null, $content = null, bool $linebreak = null): self
    {
        if ($header instanceof Closure) {
            $header = call_closure($header, new static());
        }

        return $header instanceof self ? $header : new static($header, $attributes, $content, $linebreak);
    }
}