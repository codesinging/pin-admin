<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

class CheckboxGroup extends Component
{
    /**
     * @var Checkbox[] | CheckboxButton[]
     */
    protected $items = [];

    /**
     * CheckboxGroup constructor.
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
     * Make a CheckboxGroup instance.
     *
     * @param array|string|Closure|self|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     *
     * @return self
     */
    public static function make($model = null, array $attributes = null, bool $linebreak = null): self
    {
        if ($model instanceof Closure) {
            $model = call_closure($model, new static());
        }

        return $model instanceof self ? $model : new static($model, $attributes, $linebreak);
    }

    /**
     * Add a Checkbox for the CheckboxGroup.
     *
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return Checkbox
     */
    public function checkbox($label = null, $content = null, array $attributes = null): Checkbox
    {
        is_array($label) and [$attributes, $label] = [$label, null];
        $checkbox = Checkbox::make(null, $content, $attributes);
        is_null($label) or $checkbox->label($label);
        $this->items[] = $checkbox;
        return $checkbox;
    }

    /**
     * Add a Checkbox for the CheckboxGroup.
     *
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return $this
     */
    public function addCheckbox($label = null, $content = null, array $attributes = null): self
    {
        $this->checkbox($label, $content, $attributes);
        return $this;
    }

    /**
     * Add a CheckboxButton for the CheckboxGroup.
     *
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return CheckboxButton
     */
    public function checkboxButton($label = null, $content = null, array $attributes = null): CheckboxButton
    {
        $checkbox = CheckboxButton::make($label, $content, $attributes);
        $this->items[] = $checkbox;
        return $checkbox;
    }

    /**
     * Add a CheckboxButton for the CheckboxGroup.
     *
     * @param array|string|null $label
     * @param string|array|Buildable|Closure|null $content
     * @param array|null $attributes
     *
     * @return $this
     */
    public function addCheckboxButton($label = null, $content = null, array $attributes = null): self
    {
        $this->checkboxButton($label, $content, $attributes);
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