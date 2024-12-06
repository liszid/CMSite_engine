<?php

declare(strict_types=1);

namespace Page;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Samples\sRedirect;

use Page\Classes\cDevlog;

if (
    isset($sessionUsr['userId'])
) {
    $obj = new cDevlog();
    echo $obj->Page();
} else {
    echo sRedirect::Home();
}