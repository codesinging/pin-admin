<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;
use CodeSinging\PinAdmin\Viewless\Validation\Rule;
use CodeSinging\PinAdmin\Viewless\Validation\Validate;

/**
 * Class FormItem
 *
 * @method $this prop(string $prop)
 * @method $this label(string $label)
 * @method $this labelWidth(string $labelWidth)
 * @method $this required(bool $required = true)
 * @method $this rules(array $rules)
 * @method $this error(string $error)
 * @method $this showMessage(bool $showMessage = true)
 * @method $this inlineMessage(bool $inlineMessage = true)
 * @method $this size(string $size)
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this slotLabel($contents, string $props = null)
 * @method $this slotError($contents, string $props = null)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class FormItem extends Component
{
    /**
     * @var Validate
     */
    protected $validate;

    /**
     * The default value.
     *
     * @var mixed
     */
    protected $default;

    /**
     * The component bound with the FormItem.
     *
     * @var Component
     */
    public $component;

    /**
     * FormItem constructor.
     *
     * @param array|string|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @param bool|null $linebreak
     */
    public function __construct($prop = null, $label = null, array $attributes = null, $content = null, bool $linebreak = null)
    {
        is_array($prop) and [$attributes, $prop] = [$prop, null];
        is_array($label) and [$attributes, $label] = [$label, null];

        parent::__construct($attributes, $content, $linebreak);

        is_null($prop) or $this->set('prop', $prop);
        is_null($label) or $this->set('label', $label);

        $this->validate = Validate::make();
    }

    /**
     * Make a FormItem instance.
     *
     * @param array|string|Closure|self|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @param bool|null $linebreak
     *
     * @return self
     */
    public static function make($prop = null, $label = null, array $attributes = null, $content = null, bool $linebreak = null): self
    {
        if ($prop instanceof Closure) {
            $prop = call_closure($prop, new static());
        }

        return $prop instanceof self ? $prop : new static($prop, $label, $attributes, $content, $linebreak);
    }

    /**
     * Bind an Input component for the FormItem.
     *
     * @param string|array|Closure|Input|null $model
     * @param array|null $attributes
     *
     * @return $this
     */
    public function input($model = null, array $attributes = null): self
    {
        $this->component = Input::make($model, $attributes);
        return $this;
    }

    /**
     * Add validate rules.
     *
     * @param array|string|Closure|Rule ...$rules
     *
     * @return $this
     */
    public function validate(...$rules): self
    {
        $this->validate->rule(...$rules);
        return $this;
    }

    /**
     * Set or get default value.
     *
     * @param mixed|null $default
     *
     * @return $this|mixed
     */
    public function default($default = null)
    {
        if (is_null($default)) {
            return $this->default;
        }
        $this->default = $default;
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();

        is_null($this->component) or $this->add($this->component);

        if ($rules = $this->validate->data()) {
            $this->set('rules', array_merge($rules, $this->get('rules', [])));
        }
    }
}