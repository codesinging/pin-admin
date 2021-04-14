<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Foundation;

use Closure;
use CodeSinging\PinAdmin\Support\CallClosure;

class Attribute extends Buildable
{
    use CallClosure;

    /**
     * @var array All of the attribute items.
     */
    protected $items = [];

    /**
     * The value's placeholders to replace when build.
     *
     * @var array
     */
    protected $placeholders = [];

    /**
     * Attribute constructor.
     *
     * @param array|Attribute|Closure ...$attributes
     */
    public function __construct(...$attributes)
    {
        foreach ($attributes as $attribute) {
            $this->set($attribute);
        }
    }

    /**
     * Set one or multiple properties.
     *
     * @param string|array|Attribute|Closure|null $key
     * @param mixed $value
     *
     * @return $this
     */
    public function set($key, $value = null): self
    {
        if (!empty($key)) {
            if ($key instanceof Closure) {
                $key = $this->callClosure($key, new self());
            }

            if ($key instanceof self) {
                $key = $key->all();
            }

            if (is_string($key)) {
                $this->items[$key] = $value;
            } elseif (is_array($key)) {
                foreach ($key as $k => $v) {
                    if (is_int($k)) {
                        $this->items[$v] = null;
                    } else {
                        $this->items[$k] = $v;
                    }
                }
            }
        }

        return $this;
    }

    /**
     * Get the attribute value of the given key.
     *
     * @param string $key
     * @param null $default
     *
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        return $this->items[$key] ?? $default;
    }

    /**
     * Determine if the given Property exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->items);
    }

    /**
     * Remove the attribute with specified name
     *
     * @param string $key
     *
     * @return $this
     */
    public function remove(string $key): self
    {
        unset($this->items[$key]);
        return $this;
    }

    /**
     * Determine if the attribute items is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * Clear all items.
     *
     * @return $this
     */
    public function clear(): self
    {
        $this->items = [];
        return $this;
    }

    /**
     * Get all of the attribute items.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Set placeholders.
     *
     * @param array $placeholders
     *
     * @return $this
     */
    public function placeholder(array $placeholders): self
    {
        $this->placeholders = array_merge($this->placeholders, $placeholders);
        return $this;
    }

    /**
     * Replace placeholders of the value.
     *
     * @param $value
     *
     * @return mixed
     */
    protected function parsePlaceholder($value)
    {
        if (is_string($value)) {
            foreach ($this->placeholders as $key => $placeholder) {
                $value = str_replace($key, $placeholder, $value);
            }
        }
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function build(): string
    {
        $attributes = [];
        foreach ($this->items as $key => $value) {
            is_string($value) && $value = $this->parsePlaceholder($value);
            $attributes[] = is_null($value) ? $key : sprintf('%s="%s"', $key, $value);
        }
        return implode(' ', $attributes);
    }
}