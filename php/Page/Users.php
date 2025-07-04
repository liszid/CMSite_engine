<?php

declare(strict_types=1);

use Data\{dUser};
use Toolkit\{Log, Check, Valid};
use Samples\{sTables, sRedirect, sFrame};

if (isset($sessionUsr["userId"]) && $sessionUsr["canUsers"] > 0) {
    $urlPaths = [
        "Root" => "Users",
    ];

    $dUser = new dUser();
    $Users = $dUser::Select([], "All");

    echo sFrame::Page(["path" => $urlPaths["Root"], "content" => sTables::Prompt($Users, "HOME_USERS")]);
} else {
    echo sRedirect::Home();
}
?>
