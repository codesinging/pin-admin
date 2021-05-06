<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use Closure;
use CodeSinging\PinAdmin\Viewless\Foundation\Attribute;
use CodeSinging\PinAdmin\Viewless\Foundation\Buildable;
use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Form
 *
 * @method $this model(string|array $model)
 * @method $this rules(string|array $rules)
 * @method $this inline(bool $inline = true)
 * @method $this labelPosition(string $labelPosition)
 * @method $this labelWidth(string $labelWidth)
 * @method $this labelSuffix(string $labelSuffix)
 * @method $this hideRequiredAsterisk(bool $hideRequiredAsterisk = true)
 * @method $this showMessage(bool $showMessage = true)
 * @method $this inlineMessage(bool $inlineMessage = true)
 * @method $this statusIcon(bool $statusIcon = true)
 * @method $this validateOnRuleChange(bool $validateOnRuleChange = true)
 * @method $this size(string $size)
 * @method $this disabled(bool $disabled = true)
 *
 * @method $this labelPosition_right()
 * @method $this labelPosition_left()
 * @method $this labelPosition_top()
 *
 * @method $this size_medium()
 * @method $this size_small()
 * @method $this size_mini()
 *
 * @method $this onValidate(string $handler = null, ...$parameters)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Form extends Component
{
    /**
     * @var FormItem[]
     */
    protected $items = [];

    /**
     * Form constructor.
     *
     * @param array|string|null $model
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($model = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($model) and [$attributes, $model] = [$model, null];
        parent::__construct($attributes, null, $linebreak);
        is_null($model) or $this->set('model', $model);
    }

    /**
     * Make a Form instance.
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
     * Add a FormItem.
     *
     * @param array|string|Closure|FormItem|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @param bool|null $linebreak
     *
     * @return FormItem
     */
    public function item($prop = null, $label = null, array $attributes = null, $content = null, bool $linebreak = null): FormItem
    {
        $formItem = FormItem::make($prop, $label, $attributes, $content, $linebreak);
        $this->items[] = $formItem;
        return $formItem;
    }

    /**
     * Add a FormItem.
     *
     * @param array|string|Closure|FormItem|null $prop
     * @param array|string|null $label
     * @param array|null $attributes
     * @param array|string|Buildable|Closure|null $content
     * @param bool|null $linebreak
     *
     * @return $this
     */
    public function addItem($prop = null, $label = null, array $attributes = null, $content = null, bool $linebreak = null): self
    {
        $this->item($prop, $label, $attributes, $content, $linebreak);
        return $this;
    }

    /**
     * Get the form's default values.
     *
     * @return array
     */
    public function defaults(): array
    {
        $defaults = [];

        foreach ($this->items as $item) {
            if ($prop = $item->get('prop')) {
                $defaults[$prop] = $item->default();
            }
        }

        return $defaults;
    }

    /**
     * @return $this
     */
    protected function bindItemModel(): self
    {
        $model = $this->get('model', 'data');
        is_string($model) and $model = ltrim($model, Attribute::PREFIX);
        foreach ($this->items as $item) {
            if ($item->component instanceof Component) {
                $item->component->vModel(sprintf('%s.%s', $model, $item->get('prop')));
            }
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();

        $this->bindItemModel();

        $this->add(...$this->items);
    }
}