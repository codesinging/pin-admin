<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Foundation;

use Closure;

class Css extends Buildable
{
    /**
     * All of the css items.
     *
     * @var array
     */
    private $items = [];

    /**
     * Css constructor.
     *
     * @param string|array|Css|Closure ...$classes
     */
    public function __construct(...$classes)
    {
        $this->add(...$classes);
    }

    /**
     * Parse the css classes to an array.
     *
     * @param string|array|Css|Closure $classes
     *
     * @return array
     */
    private function parse($classes)
    {
        if ($classes instanceof Closure) {
            $self = new self();
            $classes = call_user_func($classes, $self) ?? $self;
        }

        if (empty($classes)) {
            return [];
        }

        if (is_string($classes)) {
            $classes = preg_split("/[\s,]+/", $classes);
        } elseif ($classes instanceof self) {
            $classes = $classes->all();
        }

        return is_array($classes) ? $classes : [];
    }

    /**
     * Add css to the css items.
     *
     * @param string|array|Css|Closure ...$classes
     *
     * @return $this
     */
    public function add(...$classes): self
    {
        foreach ($classes as $class) {
            $class = $this->parse($class);
            $class and $this->items = array_unique(array_merge($this->items, $class));
        }

        return $this;
    }

    /**
     * Prepend css to the beginning of the css items.
     *
     * @param string|array|Css|Closure ...$classes
     *
     * @return $this
     */
    public function prepend(...$classes): self
    {
        $array = [];
        foreach ($classes as $class) {
            $class = $this->parse($class);
            $array = array_merge($array, $class);
        }
        $array and $this->items = array_unique(array_merge($array, $this->items));

        return $this;
    }

    /**
     * Determine if the give css class exists.
     *
     * @param string $class
     *
     * @return bool
     */
    public function has(string $class): bool
    {
        return in_array($class, $this->items);
    }

    /**
     * Determine if the css items is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    /**
     * Clear all css items.
     *
     * @return $this
     */
    public function clear(): self
    {
        $this->items = [];
        return $this;
    }

    /**
     * Reset the css items.
     *
     * @param string|array|Css|Closure ...$classes
     *
     * @return $this
     */
    public function reset(...$classes): self
    {
        return $this->clear()->add(...$classes);
    }

    /**
     * Get all the css items.
     *
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Build the Css object to content as a string.
     *
     * @return string
     */
    public function build(): string
    {
        return implode(' ', $this->items);
    }
}