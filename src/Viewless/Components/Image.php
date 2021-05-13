<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Image
 *
 * @method static $this make(array|string $src = null, array $attributes = null, bool $linebreak = null)
 *
 * @method $this alt(string $alt)
 * @method $this fit(string $fit)
 * @method $this hideOnClickModal(bool $hideOnClickModal = true)
 * @method $this lazy(bool $lazy = true)
 * @method $this previewSrcList(array $previewSrcList)
 * @method $this referrerPolicy(string $referrerPolicy)
 * @method $this src(string $src)
 * @method $this scrollContainer(string $scrollContainer)
 * @method $this zIndex(int $zIndex)
 * @method $this appendToBody(bool $appendToBody = true)
 *
 * @method $this fit_fill()
 * @method $this fit_contain()
 * @method $this fit_cover()
 * @method $this fit_none()
 * @method $this fit_scaleDown()
 *
 * @method $this onLoad(string $handler = null, ...$parameters)
 * @method $this onError(string $handler = null, ...$parameters)
 *
 * @method $this slotPlaceholder($contents, string $props = null, bool $linebreak = null)
 * @method $this slotError($contents, string $props = null, bool $linebreak = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Image extends Component
{
    /**
     * Image constructor.
     *
     * @param array|string|null $src
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($src = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($src) and [$attributes, $src] = [$src, null];
        parent::__construct($attributes, null, $linebreak);
        is_null($src) or $this->set('src', $src);
    }
}