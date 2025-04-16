<?php

declare(strict_types=1);

namespace Samples\sTranslate\hu;

interface ACTION
{
    const ACTION = [
        "Success" => [
            "content" => "Sikeres!",
        ],
        "Fail" => [
            "content" => "Sikertelen!",
        ],
        "Tables" => [
            "edit" => "Szerkesztés",
            "view" => "Megtekintés",
            "delete" => "Törlés",
        ],
    ];
}
?>
