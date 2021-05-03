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
 * Class RadioGroup
 *
 * @method $this value(string|int|boolean $value)
 * @method $this size(string $size)
 * @method $this disabled(bool $disabled = true)
 * @method $this textColor(string $textColor)
 * @method $this fill(string $fill)
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this onChange(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class RadioGroup extends Component
{
    /**
     * @var Radio[]|RadioButton[]
     */
    protected $items = [];

    /**
     * RadioGroup constructor.
     *
     * @param array|string|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($model = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        parent::__construct($attributes, null, $linebreak);
        is_null($model) or $this->vModel($model);
    }

    /**
     * Make a RadioGroup instance.
     *
     * @param array|string|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     *
     * @return static
     */
    public static function make($model = null, array $attributes = null, bool $linebreak = null): self
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        return $model instanceof self ? $model : new static($model, $attributes, $linebreak);
    }

    /**
     * Add a Radio.
     *
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return Radio
     */
    public function radio($label = null, $content = null, array $attributes = null): Radio
    {
        $radio = Radio::make(null, $label, $content, $attributes);
        $this->items[] = $radio;
        return $radio;
    }

    /**
     * Add a Radio.
     *
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return $this
     */
    public function addRadio($label = null, $content = null, array $attributes = null): self
    {
        $this->radio($label, $content, $attributes);
        return $this;
    }

    /**
     * Add a RadioButton.
     *
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return RadioButton
     */
    public function radioButton($label = null, $content = null, array $attributes = null): RadioButton
    {
        $radioButton = RadioButton::make($label, $content, $attributes);
        $this->items[] = $radioButton;
        return $radioButton;
    }

    /**
     * Add a RadioButton.
     *
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return $this
     */
    public function addRadioButton($label = null, $content = null, array $attributes = null): self
    {
        $this->radioButton($label, $content, $attributes);
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $this->add(...$this->items);
    }
}