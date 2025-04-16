<?php

declare(strict_types=1);

namespace Samples\sTranslate\hu;

interface ROLE
{
    const ROLE_CARD_COLOR = "cyan";

    const ROLE = [
        "canAdministrative" => [
            "color" => "secondary",
            "header" => "Available function",
            "respective" => "Administrative",
            "short" => "cA",
            "desc" => "<b>Administrative</b> permission",
            "select_type" => "state",
        ],
        "mngUsers" => [
            "color" => self::ROLE_CARD_COLOR,
            "header" => "Available function",
            "respective" => "Administrative/Users",
            "short" => "mU",
            "desc" => "Manage <b>Users</b>",
            "select_type" => "state",
        ],
        "mngGroups" => [
            "color" => self::ROLE_CARD_COLOR,
            "header" => "Available function",
            "respective" => "Administrative/Groups",
            "short" => "mG",
            "desc" => "Manage <b>Permissions</b>",
            "select_type" => "state",
        ],
        "mngHuntgroups" => [
            "color" => self::ROLE_CARD_COLOR,
            "header" => "Available function",
            "respective" => "Administrative/Huntgroups",
            "short" => "mHGG",
            "desc" => "Manage <b>Groups</b>",
            "select_type" => "state",
        ],
        "mngTools" => [
            "color" => self::ROLE_CARD_COLOR,
            "header" => "Expandable function",
            "respective" => "Administrative/Tools",
            "short" => "mT",
            "desc" => "Manage <b>Administrative Tools</b>",
            "select_type" => "state",
        ],
        "canUsers" => [
            "color" => self::ROLE_CARD_COLOR,
            "header" => "Available function",
            "respective" => "Users",
            "short" => "cUs",
            "desc" => "<b>[Users]</b> permission",
            "select_type" => "state",
        ],
        "canEdit" => [
            "color" => self::ROLE_CARD_COLOR,
            "header" => "Available function",
            "respective" => "Profile",
            "short" => "cE",
            "desc" => "Edit <b>Profile</b>",
            "select_type" => "state",
        ],
        "canLogin" => [
            "color" => self::ROLE_CARD_COLOR,
            "header" => "Available function",
            "respective" => "Profile",
            "short" => "cE",
            "desc" => "<b>Login</b> permission",
            "select_type" => "state",
        ],
    ];
}
?>
