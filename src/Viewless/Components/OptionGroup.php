<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

class OptionGroup extends Component
{
    /**
     * @var Option[]
     */
    protected $options = [];

    /**
     * OptionGroup constructor.
     *
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($label = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($label) and [$attributes, $label] = [$label, null];
        parent::__construct($attributes, null, $linebreak);
        is_null($label) or $this->set('label', $label);
    }

    /**
     * Make an OptionGroup instance.
     *
     * @param array|string|null $label
     * @param array|null $attributes
     * @param bool|null $linebreak
     *
     * @return self
     */
    public static function make($label = null, array $attributes = null, bool $linebreak = null): self
    {
        if ($label instanceof Closure) {
            $label = call_closure($label, new static());
        }

        return $label instanceof self ? $label : new static($label, $attributes, $linebreak);
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
        $this->options[] = $option;
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
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $this->add(...$this->options);
    }
}