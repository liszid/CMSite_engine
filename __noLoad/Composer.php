<?php

declare(strict_types=1);

require_once 'AutoLoader.php';

use Samples\sSite;

use Toolkit\{
    Log
    ,Check
    ,Valid
    ,Upload
};

if (isset($_FILES) && !empty($_FILES)) {
    Upload::Upload();
}

$sSite = new sSite();
