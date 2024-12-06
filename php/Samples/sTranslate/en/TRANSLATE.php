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
            "navbar" => "Groups"
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
                ,'content' => '
                    <b>Adjustable permissions, privileges</b> <br />
                    <br />
                    <b>Administrative permission</b> - Users can view and edit all entries<br />
                    <b>User management</b> - Creating users, placing them in groups, resetting passwords<br />
                    <b>Manage user privileges</b> - Create and manage privilege levels<br />
                    <b>Manage user groups</b> - Create and manage user groups<br />
                    <b>Manage administrative tools</b> - Access to special administrative functions<br />
                    <b>View the interface of registered users</b> - View public data of registered users<br />
                    <b>Access rights interface</b> - Add and manage access data<br />
                    <b>Hardware interface access</b> - Add and manage hardware<br />
                    <b>Edit profile</b> - Can the user edit their own profile<br />
                    <b>Login</b> - Active state of the user, if prohibited, the user is inactive<br />
                    <br />
                    <b>View data:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Edit group privileges: </b><a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a> <br />
                    <b>Delete group: </b><a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>'
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
                ,'content' => '
                    This interface is used to create groups and assign memberships.<br />
                    When editing, you can modify the Group name, description, and members.<br />
                    When assigning group members, the CTRL/SHIFT keys help to select multiple users.<br />
                    <br />
                    <b>View Group Information:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Edit Group:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Delete:</b> <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />'
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
                    <b>Knowledge Article Types </b> Manage knowledge article types (add, delete, modify)<br />
                    <b>Site Types </b> Manage site types (add, delete, modify)<br />
                    <b>Import Data from Emu </b>
                    <b>Reset Database </b> Discard the current database and rebuild it<br />
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
    );
}
