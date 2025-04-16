<?php

declare(strict_types=1);

namespace Samples\sTables;

interface USERS
{
    const HOME_USERS = [
        "tableId" => "tableHomeUsers",
        "tableRoot" => "Users",
        "data" => [
            "userId" => ["text" => "Id", "tooltip" => ""],
            "userThumbnail" => ["text" => "Ikon", "tooltip" => ""],
            "userLastName" => ["text" => "Vezetéknév", "tooltip" => ""],
            "userFirstName" => ["text" => "Keresztnév", "tooltip" => ""],
            "userContEmail" => ["text" => "E-mail", "tooltip" => ""],
        ],
        "button" => [],
    ];
}
?>
