<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models;

use CodeSinging\PinAdmin\Models\Support\IndentTreeLists;

class AdminMenu extends Model
{
    use IndentTreeLists;

    protected $fillable = [
        'parent_id',
        'name',
        'url',
        'icon',
        'sort',
        'is_home',
        'is_active',
        'is_opened',
        'status',
    ];

    protected $casts = [
        'is_home' => 'boolean',
        'is_opened' => 'boolean',
        'status' => 'boolean',
    ];
}