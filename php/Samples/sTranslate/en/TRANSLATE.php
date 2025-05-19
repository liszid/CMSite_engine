<?php

declare(strict_types=1);

namespace Samples\sTranslate\en;

interface TRANSLATE
{
    const TRANSLATE = [
        "Administrative" => [
            "navbar" => "Admin",
            "fa" => "pencil-square",
            "title" => "Administration",
            "help" => "To use the Administrative interface, click on the tab",
            "card" => "",
        ],
        "Administrative/Users" => [
            "navbar" => "Users",
            "fa" => "user",
            "title" => "User Management",
            "help" =>
                "To manage user accounts, click on the 'Admin' button in the menu bar and select the 'Users' option",
            "card" => "To edit accounts, click on the card",
            "info" => [
                "color" => "success",
                "header" => "Information",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => '
                    The default password for new users is their username, and their privilege is the "Default" privilege with ID 2.<br />
                    <br />
                    <b>Login name:</b> User\'s username<br />
                    <b>Email address:</b> Email associated with the user account for future notifications<br />
                    <b>Privilege level:</b> The current/selected privilege level for the user<br />
                    <br />
                    <b>Change user privilege level:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Reset user password:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-undo" aria-hidden="true"></i></a><br />
                    <b>Delete user account:</b> <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>',
            ],
            "action" => [
                "Add" => "Add User",
                "Edit" => "Edit User Privileges",
                "Reset" => "Reset User Password",
                "Delete" => "Delete User",
            ],
        ],
        "Administrative/Groups" => [
            "navbar" => "Authorities",
            "fa" => "users",
            "title" => "Group Management",
            "help" => "To manage groups, click on the 'Admin' button in the menu bar and select the 'Groups' option",
            "card" => "To edit groups, click on the card",
            "info" => [
                "color" => "success",
                "header" => "Information",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => "",
            ],
            "action" => [
                "Add" => "Add Group",
                "Edit" => "Edit Group",
                "View" => "View Group",
                "Delete" => "Delete Group",
            ],
        ],
        "Administrative/Huntgroups" => [
            "navbar" => "Groups",
            "fa" => "users",
            "title" => "Manage Groups",
            "help" => "To manage groups, click on the 'Admin' button in the menu bar and select the 'Groups' option",
            "card" => "To edit groups, click on the card",
            "info" => [
                "color" => "success",
                "header" => "Information",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => "",
            ],
            "action" => [
                "Add" => "Add Group",
                "Edit" => "Edit Group",
                "View" => "View Group",
                "Delete" => "Delete Group",
            ],
        ],
        "Administrative/Tools" => [
            "navbar" => "Tools",
            "fa" => "wrench",
            "title" => "Tools",
            "help" => "",
            "card" => "To access administrative tools, click on the card",
            "info" => [
                "color" => "success",
                "header" => "Information",
                "title" => "",
                "content" => '
                    <b>User Events </b> View recent user activities<br />
                ',
            ],
            "action" => [
                "Delete" => "Reset Database",
                "Logs" => "View Events",
                "Emu_Import" => "Import from Emu",
            ],
        ],
        "Users" => [
            "navbar" => "Users",
            "fa" => "user",
            "title" => "View Users",
            "help" => "To view registered users' availability, click on the 'Availability' button in the menu bar",
            "card" => "Click on the card to view registered users' availability",
        ],
        "Home" => [
            "navbar" => "Home",
            "fa" => "home",
            "title" => "Home",
            "help" => "",
            "card" => "",
        ],
        "Devlog" => [
            "navbar" => "DevNotes",
            "fa" => "cog",
            "title" => "Developer Notes",
            "help" => "",
            "card" => "",
        ],
        "Login" => [
            "navbar" => "Login",
            "fa" => "sign-in",
            "title" => "Login",
            "help" => "",
            "card" => "",
        ],
        "Logout" => [
            "navbar" => "Logout",
            "fa" => "sign-out",
            "title" => "Logout",
            "help" => "",
            "card" => "",
        ],
        "Profile" => [
            "navbar" => "Profile",
            "fa" => "user",
            "title" => "Profile",
            "help" =>
                "To edit your profile, click the 'Profile' button in the menu bar and then the 'Edit' button on the 'Profile' page",
            "card" =>
                "To edit your profile, click the 'Profile' button in the menu bar and then the 'Edit' button on the 'Profile' page",
        ],
        "Capacity" => [
            "navbar" => "Kapacitás",
            "fa" => "hdd-o",
            "title" => "Capacity management",
            "help" => "",
            "card" => "",
        ],
        "Capacity/Storage" => [
            "navbar" => "Storage",
            "fa" => "hdd-o",
            "title" => "View Storage",
            "help" => "",
            "card" => "To view Storages, click on the card",
            "action" => [
                "View" => "View Storage",
            ],
        ],
        "Capacity/Group" => [
            "navbar" => "Storage Group",
            "fa" => "hdd-o",
            "title" => "View Storage Groups",
            "help" => "",
            "card" => "To view Storage Groups, click on the card",
            "action" => [
                "View" => "View Storage Groups",
            ],
        ],
        "Performance" => [
            "navbar" => "Performance",
            "fa" => "hdd-o",
            "title" => "Local Performance management",
            "help" => "",
            "card" => "",
        ],
        "Performance/Laptop" => [
            "navbar" => "Performance",
            "fa" => "hdd-o",
            "title" => "Performance management",
            "help" => "",
            "card" => "Check laptop performance statistics and informantions",
            "action" => [
                "View" => "View Performance",
            ],
        ],
        "Plans" => [
            "navbar" => "Planner",
            "fa" => "calendar",
            "title" => "View Planner",
            "help" => "To view the planner, click on the 'Availability' button in the menu bar",
            "card" => "Click on the card to view the planner",
        ],
        "Calendar" => [
            "navbar" => "Calendar",
            "fa" => "calendar",
            "title" => "View Calendar",
            "help" => "To view the calendar, click on the 'Availability' button in the menu bar",
            "card" => "Click on the card to view the calendar",
            "info" => [
                "color" => "success",
                "header" => "",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => "",
            ],
            "action" => [
                "Add" => "Add Event",
                "Edit" => "Edit Event",
                "View" => "View Event",
                "Delete" => "Delete Event",
            ],
        ],
        "Plans/Calendar" => [
            "navbar" => "Calendar",
            "fa" => "calendar",
            "title" => "View Calendar",
            "help" => "To view the calendar, click on the 'Availability' button in the menu bar",
            "card" => "Click on the card to view the calendar",
            "info" => [
                "color" => "success",
                "header" => "",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => "",
            ],
            "action" => [
                "Add" => "Add Event",
                "Edit" => "Edit Event",
                "View" => "View Event",
                "Delete" => "Delete Event",
            ],
        ],
        "Plans/Kanban" => [
            "navbar" => "Tasks",
            "fa" => "list-ul",
            "title" => "View Tasks",
            "help" => "To view the kanban list, click on the button in the menu bar",
            "card" => "Click on the card to view the kanban list",
            "info" => [
                "color" => "success",
                "header" => "",
                "addButton" => true,
                "addNonModal" => false,
                "title" => "",
                "content" => "",
            ],
            "action" => [
                "Add" => "Add Event",
                "Edit" => "Edit Event",
                "View" => "View Event",
                "Delete" => "Delete Event",
            ],
        ],
    ];
}
?>
