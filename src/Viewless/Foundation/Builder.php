<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Foundation;

use Closure;
use CodeSinging\PinAdmin\Viewless\Elements\Slot;
use Illuminate\Config\Repository;
use Illuminate\Support\Str;

class Builder extends Buildable
{
    use Directive;

    /**
     * The builder's base tag.
     *
     * @var string
     */
    protected $baseTag = '';

    /**
     * The prefix of the Builder's tag.
     *
     * @var string
     */
    protected $tagPrefix = '';

    /**
     * If the builder has a closing tag.
     *
     * @var bool
     */
    protected $closing = true;

    /**
     * If the builder has linebreak between the opening tag, content and the closing tag.
     *
     * @var bool
     */
    protected $linebreak = false;

    /**
     * The Css instance.
     *
     * @var Css
     */
    public $css;

    /**
     * The Style instance.
     *
     * @var Style
     */
    public $style;

    /**
     * The Attribute instance.
     *
     * @var Attribute
     */
    public $attribute;

    /**
     * The builder's initial attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The Content instance.
     *
     * @var Content
     */
    public $content;

    /**
     * Whether the builder is buildable.
     *
     * @var bool
     */
    protected $buildable = true;

    /**
     * The builder's configuration repository.
     *
     * @var Repository
     */
    public static $config;

    /**
     * Builder constructor.
     *
     * @param string|array|null $tag
     * @param array|string|null $attributes
     * @param string|array|Buildable|Closure|null $content
     * @param bool|null $closing
     * @param bool|null $linebreak
     */
    public function __construct($tag = null, $attributes = null, $content = null, bool $closing = null, bool $linebreak = null)
    {
        if (is_string($attributes)) {
            $content = $attributes;
            $attributes = null;
        }

        if (is_string($tag)) {
            $this->baseTag($tag);
        } elseif (is_array($tag)) {
            $attributes = $tag;
        }

        is_bool($closing) and $this->closing($closing);
        is_bool($linebreak) and $this->linebreak($linebreak);

        $this->css = new Css();
        $this->style = new Style();

        $this->attribute = new Attribute($this->attributes);
        $this->attribute->set($attributes);

        $this->content = new Content($content);

        self::$config = new Repository();

        $this->initialize();
    }

    /**
     * Get the automatic base tag based on class name.
     *
     * @return string
     */
    public function autoBaseTag(): string
    {
        return Str::kebab(class_basename($this));
    }

    /**
     * Set or get the builder's base tag.
     *
     * @param string|null $tag
     *
     * @return $this|string
     */
    public function baseTag(string $tag = null)
    {
        if (is_null($tag)) {
            return $this->baseTag ?: $this->autoBaseTag();
        }
        $this->baseTag = $tag;
        return $this;
    }

    /**
     * Get the builder's tag with prefix.
     *
     * @return string
     */
    public function fullTag(): string
    {
        return $this->tagPrefix . $this->baseTag();
    }

    /**
     * Set builder's closing attribute.
     *
     * @param bool $closing
     *
     * @return $this
     */
    public function closing(bool $closing = true): self
    {
        $this->closing = $closing;
        return $this;
    }

    /**
     * Set builder's linebreak attribute.
     *
     * @param bool $linebreak
     *
     * @return $this
     */
    public function linebreak(bool $linebreak = true): self
    {
        $this->linebreak = $linebreak;
        return $this;
    }

    /**
     * Add css classes.
     *
     * @param string|array|Css|Closure ...$classes
     *
     * @return Css|$this
     */
    public function css(...$classes)
    {
        if (empty($classes)) {
            return $this->css;
        }
        $this->css->add(...$classes);
        return $this;
    }

    /**
     * Add styles or get Style instance.
     *
     * @param string|array|Style|Closure ...$styles
     *
     * @return Style|$this
     */
    public function style(...$styles)
    {
        if (empty($styles)) {
            return $this->style;
        }
        $this->style->add(...$styles);
        return $this;
    }

    /**
     * Set property values.
     *
     * @param array|string $key
     * @param mixed $value
     *
     * @return $this
     */
    public function set($key, $value = null): self
    {
        $this->attribute->set($key, $value);
        return $this;
    }

    /**
     * Get the specified property value.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return array|string|int|mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->attribute->get($key, $default);
    }

    /**
     * Get all the attributes.
     *
     * @return array
     */
    public function attributes(): array
    {
        return $this->attribute->all();
    }

    /**
     * Add contents to the content flow.
     *
     * @param string|array|Buildable|Closure ...$contents
     *
     * @return $this
     */
    public function add(...$contents): self
    {
        $this->content->add(...$contents);
        return $this;
    }

    /**
     * Prepend contents to the beginning of the content flow.
     *
     * @param string|array|Buildable|Closure ...$contents
     *
     * @return $this
     */
    public function prepend(...$contents): self
    {
        $this->content->prepend(...$contents);
        return $this;
    }

    /**
     * Add a interpolation content to the content flow.
     *
     * @param string $content
     *
     * @return $this
     */
    public function interpolation(string $content): self
    {
        $this->add(sprintf('{{ %s }}', $content));
        return $this;
    }

    /**
     * Add a named slot content to the content flow.
     *
     * @param string|array|Slot|Closure|null $name
     * @param string|array|Buildable|Closure|null $content
     * @param string|null $prop
     * @param bool|null $linebreak
     *
     * @return $this
     */
    public function slot($name = null, $content = null, string $prop = null, bool $linebreak = null): self
    {
        $slot = Slot::make($name, $content, $prop, $linebreak);

        $this->add($slot);

        return $this;
    }

    /**
     * Get the builder's contents.
     *
     * @return string
     */
    public function contents(): string
    {
        return $this->content->build();
    }

    /**
     * Determine whether the builder is buildable.
     *
     * @param bool $buildable
     *
     * @return $this
     */
    public function buildable(bool $buildable = true): self
    {
        $this->buildable = $buildable;
        return $this;
    }

    /**
     * Whether the builder is buildable.
     *
     * @return bool
     */
    public function isBuildable(): bool
    {
        return $this->buildable;
    }

    /**
     * Set/get configuration value or get the configuration repository instance.
     *
     * @param string|array|null $key
     * @param mixed|null $value
     *
     * @return $this|Repository|mixed
     */
    public function config($key = null, $value = null)
    {
        if (is_null($key)) {
            return self::$config;
        }

        if (is_string($key)) {
            return self::$config->get($key, $value);
        }

        if (is_array($key)) {
            self::$config->set($key);
            return $this;
        }

        return self::$config;
    }

    /**
     * Get all builder configuration.
     *
     * @return array
     */
    public static function configs(): array
    {
        return self::$config->all();
    }

    /**
     * The methods to set properties.
     *
     * @param string $name
     * @param array $arguments
     *
     * @return $this
     */
    public function __call(string $name, array $arguments): self
    {
        if (Str::contains($name, '_')) {
            $this->set(Str::before($name, '_'), Str::kebab(Str::after($name, '_')));
        } elseif (preg_match('/on[A-Z][a-zA-Z]+/', $name)) {
            $event = lcfirst(substr($name, 2));
            if (count($arguments) > 1) {
                $handler = $arguments[0] . '(';
                array_shift($arguments);
                $handler .= implode(', ', $arguments);
                $handler .= ')';
            } else {
                $handler = $arguments[0] ?? $event;
            }
            $this->vOn($event, $handler);
        } elseif (preg_match('/slot[A-Z][a-zA-Z]+/', $name)) {
            $slotName = lcfirst(substr($name, 4));
            $this->slot($slotName, $arguments[0] ?? null, $arguments[1] ?? null, $arguments[2] ?? null);
        } else {
            $this->set($name, $arguments[0] ?? true);
        }

        return $this;
    }

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return static
     */
    public static function __callStatic(string $name, array $arguments): self
    {
        if ($name === 'make') {
            if (isset($arguments[0])) {
                if ($arguments[0] instanceof Closure) {
                    $arguments[0] = call_closure($arguments[0], new static());
                }
                return $arguments[0] instanceof self ? $arguments[0] : new static(...$arguments);
            }
            return new static();
        }
        return new static();
    }

    /**
     * Initialize the builder.
     */
    protected function initialize(): void
    {
    }

    /**
     * Ready to build the builder.
     */
    protected function ready(): void
    {
    }

    /**
     * Build content as a string of the object.
     *
     * @return string
     */
    public function build(): string
    {
        if (!$this->isBuildable()) {
            return '';
        }

        $this->ready();

        if (!$this->css->isEmpty()) {
            $this->set(['class' => $this->css->build()]);
        }

        if (!$this->style->isEmpty()) {
            $this->set(['style' => $this->style->build()]);
        }

        if ($this->linebreak) {
            $this->content->linebreak();
        }

        return sprintf(
            '<%s%s>%s%s%s%s',
            $this->fullTag(),
            $this->attribute->isEmpty() ? '' : ' ' . $this->attribute->build(),
            $this->linebreak && !$this->content->isEmpty() ? PHP_EOL : '',
            $this->content->build(),
            $this->linebreak && $this->closing ? PHP_EOL : '',
            $this->closing ? '</' . $this->fullTag() . '>' : ''
        );
    }
}