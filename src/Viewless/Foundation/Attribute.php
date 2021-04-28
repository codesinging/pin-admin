<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Foundation;

use Illuminate\Support\Str;

class Attribute extends Buildable
{
    /**
     * The prefix for property.
     */
    const PREFIX = ':';

    /**
     * @var array All of the attribute items.
     */
    protected $items = [];

    /**
     * Attribute constructor.
     *
     * @param string|array|null $key
     * @param mixed|null $value
     */
    public function __construct($key = null, $value = null)
    {
        is_null($key) or $this->add($key, $value);
    }

    /**
     * Add attribute items.
     *
     * @param string|array|null $key
     * @param mixed|null $value
     */
    public function add($key, $value = null)
    {
        $this->set($key, $value);
    }

    /**
     * Set one or multiple attribute items.
     *
     * @param string|array|null $key
     * @param mixed $value
     *
     * @return $this
     */
    public function set($key, $value = null): self
    {
        if (!empty($key)) {
            if (is_string($key)) {
                $this->items[$key] = $value;
            } elseif (is_array($key)) {
                foreach ($key as $k => $v) {
                    if (is_int($k) && is_string($v)){
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
     * Parse an attribute item to string.
     *
     * @param string|null $key
     * @param mixed|null $value
     * @param bool $isProperty
     *
     * @return string
     */
    public function parse(string $key = null, $value = null, bool $isProperty = false): string
    {
        if (empty($key)) {
            return '';
        }

        if (Str::startsWith($key, self::PREFIX)){
            $key = substr($key, 1);
            $isProperty = true;
        }

        if (is_string($value)) {
            if (Str::startsWith($value, self::PREFIX)) {
                $value = substr($value, 1);
                $isProperty = true;
            } elseif (Str::startsWith($value, "\\" . self::PREFIX)) {
                $value = substr($value, 1);
            }
        } elseif ($value === true) {
            $value = 'true';
            $isProperty = true;
        } elseif ($value === false) {
            $value = 'false';
            $isProperty = true;
        } elseif (is_int($value) || is_float($value) || is_double($value)) {
            $value = (string)$value;
            $isProperty = true;
        } elseif (is_null($value) && $isProperty) {
            $value = 'true';
        } elseif (is_array($value)) {
            $value = json_encode($value);
            $isProperty = true;
        }

        $key = Str::kebab($key);

        if (is_null($value)) {
            return sprintf('%s', $key);
        }

        if ($isProperty) {
            return sprintf(':%s="%s"', $key, $value);
        } else {
            return sprintf('%s="%s"', $key, $value);
        }
    }

    /**
     * @inheritDoc
     */
    public function build(): string
    {
        $attributes = [];
        foreach ($this->items as $key => $value) {
            $attributes[] = $this->parse($key, $value);
        }
        return implode(' ', $attributes);
    }
}