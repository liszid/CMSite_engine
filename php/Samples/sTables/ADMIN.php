<?php

declare(strict_types=1);

namespace Samples\sTables;

interface ADMIN
{
    const ADMIN_GROUPS = [
        "tableId" => "tableAdminGroups",
        "tableRoot" => "Administrative/Groups",
        "tableRole" => "mngGroups",
        "data" => [
            "groupId" => ["text" => "Id", "tooltip" => "", "never" => "true"],
            "groupName" => ["text" => "Név", "tooltip" => ""],
            "groupDesc" => ["text" => "Leírás", "tooltip" => ""],
        ],
        "button" => [
            ["color" => "warning", "fa" => "th-list", "action" => "View", "tooltip" => "Megtekintés", "level" => 1],
            ["color" => "warning", "fa" => "pencil", "action" => "Edit", "tooltip" => "Szerkesztés", "level" => 1],
            ["color" => "danger", "fa" => "trash", "action" => "Delete", "tooltip" => "Törlés", "level" => 1],
        ],
    ];

    const ADMIN_HUNTGROUPS = [
        "tableId" => "tableAdminHuntgroups",
        "tableRoot" => "Administrative/Huntgroups",
        "tableRole" => "mngHuntgroups",
        "data" => [
            "huntgroupId" => ["text" => "Id", "tooltip" => "", "never" => "true"],
            "huntgroupName" => ["text" => "Név", "tooltip" => ""],
            "huntgroupDesc" => ["text" => "Leírás", "tooltip" => ""],
        ],
        "button" => [
            ["color" => "warning", "fa" => "th-list", "action" => "View", "tooltip" => "Megtekintés", "level" => 1],
            ["color" => "warning", "fa" => "pencil", "action" => "Edit", "tooltip" => "Szerkesztés", "level" => 1],
            ["color" => "danger", "fa" => "trash", "action" => "Delete", "tooltip" => "Törlés", "level" => 1],
        ],
    ];

    const ADMIN_MEMBERSHIP = [
        "tableId" => "tableAdminMembership",
        "tableRoot" => "Administrative/Membership",
        "tableRole" => "mngMembers",
        "data" => [
            "groupMemberId" => ["text" => "Id", "tooltip" => "", "never" => "true"],
            "groupName" => ["text" => "Jogosultság", "tooltip" => ""],
            "groupDesc" => ["text" => "Jogosultság leírás", "tooltip" => ""],
            "userName" => ["text" => "Felhasználónév", "tooltip" => ""],
        ],
        "button" => [
            ["color" => "warning", "fa" => "pencil", "action" => "Edit", "tooltip" => "Szerkesztés", "level" => 1],
        ],
    ];

    const ADMIN_USERS = [
        "tableId" => "tableAdminUsers",
        "tableRoot" => "Administrative/Users",
        "tableRole" => "mngUsers",
        "data" => [
            "userId" => ["text" => "Id", "tooltip" => "", "never" => "true"],
            "userName" => ["text" => "Felhasználó", "tooltip" => ""],
            "groupName" => ["text" => "Jogosultság", "tooltip" => ""],
            "groupDesc" => ["text" => "Jogosultság leírás", "tooltip" => ""],
        ],
        "button" => [
            [
                "color" => "warning",
                "fa" => "pencil",
                "action" => "Edit",
                "tooltip" => "Jogosultság kör módosítása",
                "level" => 1,
            ],
            [
                "color" => "warning",
                "fa" => "undo",
                "action" => "Reset",
                "tooltip" => "Jelszó helyreállítás",
                "level" => 1,
            ],
            [
                "color" => "danger",
                "fa" => "trash",
                "action" => "Delete",
                "tooltip" => "Fiók töröltté állítása",
                "level" => 1,
            ],
        ],
    ];

    const ADMIN_LOGS = [
        "tableId" => "tableAdminLogs",
        "tableRoot" => "Administrative/Logs",
        "tableRole" => "mngTools",
        "data" => [
            "logId" => ["text" => "Id", "tooltip" => "", "never" => "true"],
            "logAction" => ["text" => "Action", "tooltip" => ""],
            "logCategory" => ["text" => "Category", "tooltip" => ""],
            "logText" => ["text" => "Text", "tooltip" => ""],
            "userName" => ["text" => "UserName", "tooltip" => ""],
            "logDate" => ["text" => "Date", "tooltip" => ""],
        ],
        "button" => [],
    ];
}
?>
