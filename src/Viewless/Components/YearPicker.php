<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Viewless\Components;

class YearPicker extends DatePicker
{
    protected $baseTag = 'date-picker';
    protected $attributes = ['type' => 'year'];
}