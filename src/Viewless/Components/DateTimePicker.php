<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

/**
 * Class DateTimePicker
 *
 * @method $this timeArrowControl(bool $timeArrowControl = true)
 * @method $this cellClassName(string $cellClassName)
 *
 * @package CodeSinging\PinAdmin\Viewless\Components
 */
class DateTimePicker extends DatePicker
{
    protected $baseTag = 'date-picker';
    protected $attributes = ['type' => 'datetime'];
}