<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Elements\Icon;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Link
 *
 * @method static $this make(array|string|Closure|self $content = null, array|string $href = null, array|string $type = null, array $attributes = null)
 *
 * @method $this type(string $type)
 * @method $this underline(bool $underline = true)
 * @method $this disabled(bool $disabled = true)
 * @method $this href(string $href)
 * @method $this icon(string $icon)
 *
 * @method $this type_primary()
 * @method $this type_success()
 * @method $this type_warning()
 * @method $this type_danger()
 * @method $this type_info()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Link extends Component
{
    protected $iconSuffix;

    /**
     * Link constructor.
     *
     * @param array|string|null $content
     * @param array|string|null $href
     * @param array|string|null $type
     * @param array|null $attributes
     */
    public function __construct($content = null, $href = null, $type = null, array $attributes = null)
    {
        is_array($content) and [$attributes, $content] = [$content, null];
        is_array($href) and [$attributes, $href] = [$href, null];
        is_array($type) and [$attributes, $type] = [$type, null];
        parent::__construct($attributes, $content);
        is_null($href) or $this->set('href', $href);
        is_null($type) or $this->set('type', $type);
    }

    /**
     * Add an suffix icon.
     *
     * @param string $icon
     *
     * @return $this
     */
    public function iconSuffix(string $icon): self
    {
        $this->iconSuffix = $icon;
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        empty($this->iconSuffix) or $this->add(Icon::make($this->iconSuffix)->css('el-icon--right'));
    }
}