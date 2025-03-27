<?php

declare(strict_types=1);

namespace Samples\sTranslate\en;

interface TRANSLATE
{
    const TRANSLATE = array(
        "Administrative" => array(
            "navbar" => "Admin"
            ,"fa" => "pencil-square"
            ,"title" => "Administration"
            ,"help" => "To use the Administrative interface, click on the tab"
            ,"card" => ""
        )
        ,"Administrative/Users" => array(
            "navbar" => "Users"
            ,"fa" => "user"
            ,"title" => "User Management"
            ,"help" => "To manage user accounts, click on the 'Admin' button in the menu bar and select the 'Users' option"
            ,"card" => "To edit accounts, click on the card"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Information'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => '
                    The default password for new users is their username, and their privilege is the "Default" privilege with ID 2.<br />
                    <br />
                    <b>Login name:</b> User\'s username<br />
                    <b>Email address:</b> Email associated with the user account for future notifications<br />
                    <b>Privilege level:</b> The current/selected privilege level for the user<br />
                    <br />
                    <b>Change user privilege level:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Reset user password:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-undo" aria-hidden="true"></i></a><br />
                    <b>Delete user account:</b> <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>'
            )
            ,"action" => array(
                "Add" => "Add User"
                ,"Edit" => "Edit User Privileges"
                ,"Reset" => "Reset User Password"
                ,"Delete" => "Delete User"
            )
        )
        ,"Administrative/Groups" => array(
            "navbar" => "Authorities"
            ,"fa" => "users"
            ,"title" => "Group Management"
            ,"help" => "To manage groups, click on the 'Admin' button in the menu bar and select the 'Groups' option"
            ,"card" => "To edit groups, click on the card"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Information'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add Group"
                ,"Edit" => "Edit Group"
                ,"View" => "View Group"
                ,"Delete" => "Delete Group"
            )
        )
        ,"Administrative/Huntgroups" => array(
            "navbar" => "Groups"
            ,"fa" => "users"
            ,"title" => "Manage Groups"
            ,"help" => "To manage groups, click on the 'Admin' button in the menu bar and select the 'Groups' option"
            ,"card" => "To edit groups, click on the card"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Information'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add Group"
                ,"Edit" => "Edit Group"
                ,"View" => "View Group"
                ,"Delete" => "Delete Group"
            )
        )
        ,"Administrative/Tools" => array(
            "navbar" => "Tools"
            ,"fa" => "wrench"
            ,"title" => "Tools"
            ,"help" => ""
            ,"card" => "To access administrative tools, click on the card"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Information'
                ,'title' => ''
                ,'content' => '
                    <b>User Events </b> View recent user activities<br />
                '
            )
            ,"action" => array(
                "Delete" => "Reset Database"
                ,"Logs" => "View Events"
                ,"Emu_Import" => "Import from Emu"
            )
        )
        ,"Users" => array(
            "navbar" => "Users"
            ,"fa" => "user"
            ,"title" => "View Users"
            ,"help" => "To view registered users' availability, click on the 'Availability' button in the menu bar"
            ,"card" => "Click on the card to view registered users' availability"
        )
        ,"Home" => array(
            "navbar" => "Home"
            ,"fa" => "home"
            ,"title" => "Home"
            ,"help" => ""
            ,"card" => ""
        )
        ,"Devlog" => array(
            "navbar" => "DevNotes"
            ,"fa" => "cog"
            ,"title" => "Developer Notes"
            ,"help" => ""
            ,"card" => ""
        )
        ,"Login" => array(
            "navbar" => "Login"
            ,"fa" => "sign-in"
            ,"title" => "Login"
            ,"help" => ""
            ,"card" => ""
        )
        ,"Logout" => array(
            "navbar" => "Logout"
            ,"fa" => "sign-out"
            ,"title" => "Logout"
            ,"help" => ""
            ,"card" => ""
        )
        ,"Profile" => array(
            "navbar" => "Profile"
            ,"fa" => "user"
            ,"title" => "Profile"
            ,"help" => "To edit your profile, click the 'Profile' button in the menu bar and then the 'Edit' button on the 'Profile' page"
            ,"card" => "To edit your profile, click the 'Profile' button in the menu bar and then the 'Edit' button on the 'Profile' page"
        )
        ,"Capacity" => array(
            "navbar" => "Kapacitás"
            ,"fa" => "hdd-o"
            ,"title" => "Capacity management"
            ,"help" => ""
            ,"card" => ""
        )
        ,"Capacity/Storage" => array(
            "navbar" => "Storage"
            ,"fa" => "hdd-o"
            ,"title" => "View Storage"
            ,"help" => ""
            ,"card" => "To view Storages, click on the card"
            ,"action" => array(
                "View" => "View Storage"
            )
        )
        ,"Capacity/Group" => array(
            "navbar" => "Storage Group"
            ,"fa" => "hdd-o"
            ,"title" => "View Storage Groups"
            ,"help" => ""
            ,"card" => "To view Storage Groups, click on the card"
            ,"action" => array(
                "View" => "View Storage Groups"
            )
        )
        ,"Performance" => array(
            "navbar" => "Performance"
            ,"fa" => "hdd-o"
            ,"title" => "Local Performance management"
            ,"help" => ""
            ,"card" => ""
        )
        ,"Performance/Laptop" => array(
            "navbar" => "Performance"
            ,"fa" => "hdd-o"
            ,"title" => "Performance management"
            ,"help" => ""
            ,"card" => "Check laptop performance statistics and informantions"
            ,"action" => array(
                "View" => "View Performance"
            )
        )
    );
}
?>