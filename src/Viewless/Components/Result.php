<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Result
 *
 * @method static $this make(array|string|Result|\Closure $title = null, array|string $subTitle = null, array|string $icon = null, array $attributes = null, bool $linebreak = null)
 *
 * @method $this title(string $title)
 * @method $this subTitle(string $subTitle)
 * @method $this icon(string $icon)
 *
 * @method $this icon_success()
 * @method $this icon_warning()
 * @method $this icon_info()
 * @method $this icon_error()
 *
 * @method $this slotIcon($contents)
 * @method $this slotTitle($contents)
 * @method $this slotSubTitle($contents)
 * @method $this slotExtra($contents)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Result extends Component
{
    /**
     * Result constructor.
     *
     * @param array|string|null $title
     * @param array|string|null $subTitle
     * @param array|string|null $icon
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($title = null, $subTitle = null, $icon = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($title) and [$attributes, $title] = [$title, null];
        is_array($subTitle) and [$attributes, $subTitle] = [$subTitle, null];
        is_array($icon) and [$attributes, $icon] = [$icon, null];

        parent::__construct($attributes, null, $linebreak);

        is_null($title) or $this->set('title', $title);
        is_null($subTitle) or $this->set('subTitle', $subTitle);
        is_null($icon) or $this->set('icon', $icon);
    }
}