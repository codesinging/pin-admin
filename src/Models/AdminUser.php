<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models;

class AdminUser extends AuthModel
{
    protected $fillable = [
        'mobile',
        'name',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($value)
    {
        if (!empty($value)){
            $this->attributes['password'] = bcrypt($value);
        }
    }
}