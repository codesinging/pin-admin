<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

class MonthRangePicker extends DatePicker
{
    protected $baseTag = 'date-picker';
    protected $attributes = ['type' => 'monthrange'];
}