<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

use CodeSinging\PinAdmin\Viewless\Foundation\Component;

/**
 * Class Steps
 *
 * @method static $this make(array|int $active = null, array $attributes = null, bool $linebreak = null)
 *
 * @method $this space(string|int $space)
 * @method $this direction(string $direction)
 * @method $this active(int $active)
 * @method $this processStatus(string $processStatus)
 * @method $this finishStatus(string $finishStatus)
 * @method $this alignCenter(bool $alignCenter = true)
 * @method $this simple(bool $simple = true)
 *
 * @method $this direction_vertical()
 * @method $this direction_horizontal()
 *
 * @method $this processStatus_wait()
 * @method $this processStatus_process()
 * @method $this processStatus_finish()
 * @method $this processStatus_error()
 * @method $this processStatus_success()
 *
 * @method $this finishStatus_wait()
 * @method $this finishStatus_process()
 * @method $this finishStatus_finish()
 * @method $this finishStatus_error()
 * @method $this finishStatus_success()
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class Steps extends Component
{
    /**
     * @var Step[]
     */
    protected $steps = [];

    /**
     * Steps constructor.
     *
     * @param array|int|null $active
     * @param array|null $attributes
     * @param bool|null $linebreak
     */
    public function __construct($active = null, array $attributes = null, bool $linebreak = null)
    {
        is_array($active) and [$attributes, $active] = [$active, null];
        parent::__construct($attributes, null, $linebreak);
        is_null($active) or $this->set('active', $active);
    }

    /**
     * Add a step.
     *
     * @param array|string|null $title
     * @param array|string|null $description
     * @param array|string|null $icon
     * @param array|null $attributes
     * @param bool|null $linebreak
     *
     * @return Step
     */
    public function step($title = null, $description = null, $icon = null, array $attributes = null, bool $linebreak = null): Step
    {
        $step = Step::make($title, $description, $icon, $attributes, $linebreak);
        $this->steps[] = $step;
        return $step;
    }

    /**
     * Add a step.
     *
     * @param array|string|null $title
     * @param array|string|null $description
     * @param array|string|null $icon
     * @param array|null $attributes
     * @param bool|null $linebreak
     *
     * @return $this
     */
    public function addStep($title = null, $description = null, $icon = null, array $attributes = null, bool $linebreak = null): self
    {
        $this->step($title, $description, $icon, $attributes, $linebreak);
        return $this;
    }

    /**
     * @inheritDoc
     */
    protected function ready(): void
    {
        parent::ready();
        $this->add(...$this->steps);
    }
}