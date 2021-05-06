<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

class Select extends Component
{
    /**
     * @var Option[] | OptionGroup[]
     */
    protected $items = [];

    /**
     * Select constructor.
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
     * Make a Select instance.
     *
     * @param array|string|null $model
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
     * Add an Option.
     *
     * @param array|string|null $value
     * @param array|string|null $label
     * @param array|null $attributes
     *
     * @return Option
     */
    public function option($value = null, $label = null, array $attributes = null): Option
    {
        $option = Option::make($value, $label, $attributes);
        $this->items[] = $option;
        return $option;
    }

    /**
     * Add an Option.
     *
     * @param array|string|null $value
     * @param array|string|null $label
     * @param array|null $attributes
     *
     * @return $this
     */
    public function addOption($value = null, $label = null, array $attributes = null): self
    {
        $this->option($value, $label, $attributes);
        return $this;
    }

    /**
     * Add an OptionGroup.
     *
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     *
     * @return OptionGroup
     */
    public function optionGroup($label = null, array $attributes = null, bool $linebreak = null): OptionGroup
    {
        $option = OptionGroup::make($label, $attributes, $linebreak);
        $this->items[] = $option;
        return $option;
    }

    /**
     * Add an OptionGroup.
     *
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     *
     * @return $this
     */
    public function addOptionGroup($label = null, array $attributes = null, bool $linebreak = null): self
    {
        $this->optionGroup($label, $attributes, $linebreak);
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