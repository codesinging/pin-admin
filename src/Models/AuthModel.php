<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models;

use CodeSinging\PinAdmin\Models\Support\Lists;
use CodeSinging\PinAdmin\Models\Support\SerializeDate;
use CodeSinging\PinAdmin\Models\Support\StaticMethods;
use Illuminate\Foundation\Auth\User;

class AuthModel extends User
{
    use Lists;
    use SerializeDate;
    use StaticMethods;
}