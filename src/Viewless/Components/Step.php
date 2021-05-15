<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Step
 *
 * @method static $this make(array|string $title = null, array|string $description = null, array|string $icon = null, array $attributes = null, bool $linebreak = null)
 *
 * @method $this title(string $title)
 * @method $this description(string $description)
 * @method $this icon(string $icon)
 * @method $this status(string $status)
 *
 * @method $this status_wait()
 * @method $this status_process()
 * @method $this status_finish()
 * @method $this status_error()
 * @method $this status_success()
 *
 * @method $this slotIcon($contents, string $props = null, bool $linebreak = null)
 * @method $this slotTitle($contents, string $props = null, bool $linebreak = null)
 * @method $this slotDescription($contents, string $props = null, bool $linebreak = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Step extends Component
{
    /**
     * Step constructor.
     *
     * @param array|string|null $title
     * @param array|string|null $description
     * @param array|string|null $icon
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($title = null, $description = null, $icon = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($title) and [$attributes, $title] = [$title, null];
        is_array($description) and [$attributes, $description] = [$description, null];
        is_array($icon) and [$attributes, $icon] = [$icon, null];

        parent::__construct($attributes, null, $linebreak);

        is_null($title) or $this->set('title', $title);
        is_null($description) or $this->set('description', $description);
        is_null($icon) or $this->set('icon', $icon);
    }
}