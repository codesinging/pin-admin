<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Foundation;

use Closure;

class Style extends Buildable
{
    /**
     * All of the style items.
     *
     * @var array
     */
    private $items = [];

    /**
     * Style constructor.
     *
     * @param string|array|Style|Closure ...$styles
     */
    public function __construct(...$styles)
    {
        $this->add(...$styles);
    }

    /**
     * Parse the styles to an array.
     *
     * @param string|array|Style|Closure $styles
     *
     * @return array
     */
    private function parse($styles)
    {
        if ($styles instanceof Closure) {
            $self = new self();
            $styles = call_user_func($styles, $self) ?? $self;
        }

        if (empty($styles)) {
            return [];
        }

        if (is_string($styles)) {
            return $this->convert($styles);
        }

        if (is_array($styles)) {
            return $styles;
        }

        if ($styles instanceof self) {
            return $styles->all();
        }

        return [];
    }

    /**
     * Convert styles from a string to an array.
     *
     * @param string $styles
     *
     * @return array
     */
    private function convert(string $styles): array
    {
        $result = [];
        $array = explode(';', $styles);

        foreach ($array as $item) {
            if ($item = trim($item)) {
                list($key, $value) = explode(':', $item);
                $result[trim($key)] = trim($value, ' ;');
            }
        }

        return $result;
    }

    /**
     * Add styles
     *
     * @param string|array|Style|Closure ...$styles
     *
     * @return $this
     */
    public function add(...$styles): self
    {
        foreach ($styles as $style) {
            $style = $this->parse($style);
            $this->items = array_merge($this->items, $style);
        }

        return $this;
    }

    /**
     * Prepend styles to the beginning of the style items.
     *
     * @param string|array|Style|Closure ...$styles
     *
     * @return $this
     */
    public function prepend(...$styles): self
    {
        $array = [];
        foreach ($styles as $style) {
            $style = $this->parse($style);
            $array = array_merge($array, $style);
        }
        $this->items = array_merge($array, $this->items);

        return $this;
    }

    /**
     * Determine if the style items is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * Clear all the style items.
     *
     * @return $this
     */
    public function clear(): self
    {
        $this->items = [];
        return $this;
    }

    /**
     * Reset the style items.
     *
     * @param string|array|Style|Closure ...$styles
     *
     * @return $this
     */
    public function reset(...$styles): self
    {
        return $this->clear()->add(...$styles);
    }

    /**
     * Get all the style items.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Build the style to a string.
     *
     * @return string
     */
    public function build(): string
    {
        $array = [];
        foreach ($this->items as $key => $value) {
            $array[] = sprintf('%s:%s;', $key, $value);
        }

        return implode(' ', $array);
    }
}