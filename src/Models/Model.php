<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models;

use CodeSinging\PinAdmin\Models\Support\Lists;
use CodeSinging\PinAdmin\Models\Support\SerializeDate;
use CodeSinging\PinAdmin\Models\Support\StaticMethods;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use Lists;
    use SerializeDate;
    use StaticMethods;
}