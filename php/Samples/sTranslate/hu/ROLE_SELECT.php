<?php

declare(strict_types=1);

namespace Samples\sTranslate\hu;

interface ROLE_SELECT
{
    const ROLE_SELECT = [
        "state" => [["id" => 0, "name" => "Disabled"], ["id" => 1, "name" => "Enabled"]],
        "access" => [
            ["id" => 0, "name" => "Disabled"],
            ["id" => 1, "name" => "Read"],
            ["id" => 3, "name" => "Write/Read"],
            ["id" => 7, "name" => "Full"],
        ],
    ];
}
?>
