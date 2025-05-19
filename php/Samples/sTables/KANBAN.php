<?php

declare(strict_types=1);

namespace Samples\sTables;

interface KANBAN
{
    const KANBAN = [
        "tableId" => "tableKanban",
        "tableRoot" => "Plans/Kanban",
        "tableRole" => "canLogin",
        "sortKey" => ["kanbanTypeId", "asc"], 
        "data" => [
            "kanbanId" => ["text" => "Id", "tooltip" => "", "never" => "true"],
            "kanbanTypeId" => ["text" => "Id", "tooltip" => "", "never" => "true"],
            "kanbanTypeName" => ["text" => "Állapot", "tooltip" => ""],
            "kanbanTitle" => ["text" => "Feladat", "tooltip" => ""],
        ],
        "button" => [
            //["color" => "warning", "fa" => "th-list", "action" => "View", "tooltip" => "Megtekintés", "level" => 1],
            ["color" => "warning", "fa" => "pencil", "action" => "Edit", "tooltip" => "Szerkesztés", "level" => 1],
            ["color" => "danger", "fa" => "trash", "action" => "Delete", "tooltip" => "Törlés", "level" => 1],
        ],
    ];
}
?>
