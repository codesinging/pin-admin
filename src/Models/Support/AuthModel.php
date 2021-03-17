<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models\Support;

use Illuminate\Foundation\Auth\User;

class AuthModel extends User
{
    use Lists;
    use SerializeDate;
}