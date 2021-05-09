<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

class DateRangePicker extends DatePicker
{
    protected $baseTag = 'date-picker';
    protected $attributes = ['type' => 'daterange'];
}