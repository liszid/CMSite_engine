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
        ,"Administrative/Tools/Knowledge_Type" => array(
            "navbar" => "Knowledge Article Types"
            ,"fa" => "wrench"
            ,"title" => "Knowledge Article Types"
            ,"help" => ""
            ,"card" => "Click on the card to manage knowledge article types"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Information'
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add"
                ,"Edit" => "Edit"
                ,"Delete" => "Delete"
            )
        )
        ,"Administrative/Tools/Company_Site_Type" => array(
            "navbar" => "Site Types"
            ,"fa" => "wrench"
            ,"title" => "Site Types"
            ,"help" => ""
            ,"card" => "Click on the card to manage site types"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Information'
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add"
                ,"Edit" => "Edit"
                ,"Delete" => "Delete"
            )
        )
        ,"Users" => array(
            "navbar" => "Users"
            ,"fa" => "user"
            ,"title" => "View Users"
            ,"help" => "To view registered users' availability, click on the 'Availability' button in the menu bar"
            ,"card" => "Click on the card to view registered users' availability"
        )
        ,"Plans" => array(
            "navbar" => "Planner"
            ,"fa" => "calendar"
            ,"title" => "View Planner"
            ,"help" => "To view the planner, click on the 'Availability' button in the menu bar"
            ,"card" => "Click on the card to view the planner"
        )
		,"Calendar" => array(
            "navbar" => "Calendar"
            ,"fa" => "calendar"
            ,"title" => "View Calendar"
            ,"help" => "To view the calendar, click on the 'Availability' button in the menu bar"
            ,"card" => "Click on the card to view the calendar"
            ,"info" => array(
                'color' => 'success'
                ,'header' => ''
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add Event"
                ,"Edit" => "Edit Event"
                ,"View" => "View Event"
                ,"Delete" => "Delete Event"
            )
        )
        ,"Plans/Calendar" => array(
            "navbar" => "Calendar"
            ,"fa" => "calendar"
            ,"title" => "View Calendar"
            ,"help" => "To view the calendar, click on the 'Availability' button in the menu bar"
            ,"card" => "Click on the card to view the calendar"
            ,"info" => array(
                'color' => 'success'
                ,'header' => ''
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add Event"
                ,"Edit" => "Edit Event"
                ,"View" => "View Event"
                ,"Delete" => "Delete Event"
            )
        )
        ,"Plans/Kanban" => array(
            "navbar" => "Kanban"
            ,"fa" => "calendar"
            ,"title" => "View Kanban"
            ,"help" => "To view the kanban list, click on the 'Availability' button in the menu bar"
            ,"card" => "Click on the card to view the kanban list"
            ,"info" => array(
                'color' => 'success'
                ,'header' => ''
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add Event"
                ,"Edit" => "Edit Event"
                ,"View" => "View Event"
                ,"Delete" => "Delete Event"
            )
        )
        ,"Plans/Groceries" => array(
            "navbar" => "Groceries"
            ,"fa" => "calendar"
            ,"title" => "View Groceries"
            ,"help" => "To view the Groceries list, click on the 'Availability' button in the menu bar"
            ,"card" => "Click on the card to view the Groceries list"
            ,"info" => array(
                'color' => 'success'
                ,'header' => ''
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add Event"
                ,"Edit" => "Edit Event"
                ,"View" => "View Event"
                ,"Delete" => "Delete Event"
            )
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
        ,"Hardware" => array(
            "navbar" => "Hardware"
            ,"fa" => "hdd-o"
            ,"title" => "Hardware"
            ,"help" => "Reading/writing/editing hardware (depending on permissions) is available by clicking the 'Hardware' button in the menu bar"
            ,"card" => "Click on the card to view hardware"
        )
        ,"Company" => array(
            "navbar" => "Customer Data"
            ,"fa" => "building-o"
            ,"title" => "Customer Data"
            ,"help" => "Reading/writing/editing customer-related data (depending on permissions) is available by clicking the 'Companies' button in the menu bar"
            ,"card" => "Click on the card to view customer-related data"
        )
        ,"Company/Company" => array(
            "navbar" => "Customer"
            ,"fa" => "building-o"
            ,"title" => "Customer Data"
            ,"help" => "Access to reading/writing/editing customer data (depending on permission level) is available by clicking the 'Customer' button in the menu bar"
            ,"card" => "Click on the card to view customer data"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Information'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => '
                    In this interface, you can add partners, customers, to whom you can later associate sites, hardware, and accesses.<br />
                    <br />
                    <b>Customer Name:</b> Name/registered name of the company<br />
                    <b>Customer Description:</b> Comment about the company, for example: Scope of activity<br />
                    <br />
                    <b>View Data:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Edit Customer:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Delete:</b> <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />'
            )
            ,"action" => array(
                "Add" => "Add Customer"
                ,"Edit" => "Edit Customer Data"
                ,"View" => "View Customer Data"
                ,"Delete" => "Delete Customer"
                ,"Filter" => "Filter Data by Company"
            )
        )
        ,"Company/Site" => array(
            "navbar" => "Site"
            ,"fa" => "building-o"
            ,"title" => "Site Data"
            ,"help" => "Access to reading/writing/editing customer site data (depending on permission level) is available by clicking the 'Customer' button in the menu bar"
            ,"card" => "Click on the card to view customer site data"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Information'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => '
                    In this interface, you can add sites, branches related to partners or customers.<br />
                    <br />
                    <b>Company Name:</b> Name/registered name of the company<br />
                    <b>Company Description:</b> Comment about the company, for example: "Logistics company", "Service provider" etc.<br />
                    <b>Tax Number:</b> Company tax number<br />
                    <b>Registry Number:</b> Registration number of the company<br />
                    <b>Site Name:</b> Name of the site<br />
                    <b>Site Type:</b> Type of the site<br />
                    <b>City:</b> City of the site<br />
                    <b>Zip Code:</b> Zip code of the site<br />
                    <b>Street:</b> Street and house number of the site<br />
                    <b>Phone Number:</b> Phone number of the site<br />
                    <b>Email:</b> Email address of the site<br />
                    <br />
                    Additionally, you can provide the following data for the site manager and deputy manager:<br />
                    <b>First Name:</b> First name of the site manager/deputy manager<br />
                    <b>Last Name:</b> Last name of the site manager/deputy manager<br />
                    <b>Phone Number:</b> Phone number of the site manager/deputy manager<br />
                    <b>Email:</b> Email address of the site manager/deputy manager<br />
                    <br />
                    <b>View Data:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Edit Site:</b> <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Delete:</b> <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />'
            )
            ,"action" => array(
                "Add" => "Add Site"
                ,"Edit" => "Edit Site Data"
                ,"View" => "View Site Data"
                ,"Delete" => "Delete Site"
            )
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
        ,"Informations" => array(
            "navbar" => "Information"
            ,"fa" => "info"
            ,"title" => "Information"
            ,"help" => "Access to reading/writing/editing information (depending on permission level) is available by clicking the 'Knowledge' button in the menu bar"
            ,"card" => "Click on the card to view information"
        )
        ,"Informations/Access" => array(
            "navbar" => "Passwords"
            ,"fa" => "user-secret"
            ,"title" => "Password Information"
            ,"help" => "Access to reading/writing/editing password information (depending on permission level) is available by clicking the 'Access' button in the menu bar"
            ,"card" => "Click on the card to view password information"
            ,"info" => array(
                'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => ''
            )
            ,"action" => array(
                "Add" => "Add Password"
                ,"Edit" => "Edit Password"
                ,"View" => "View Password"
                ,"Delete" => "Delete Password"
            )
        )
        ,"Informations/Passtorage" => array(
            "navbar" => "Password Vaults"
            ,"fa" => "hdd-o"
            ,"title" => "Password Vault Information"
            ,"help" => "Access to reading/writing/editing password vault information (depending on permission level) is available by clicking the 'Hardware' button in the menu bar"
            ,"card" => "Click on the card to view password vault information"
            ,"info" => array(
                'addButton' => true
                ,'addNonModal' => false
                ,'color' => 'success'
                ,'header' => 'Information'
                ,'title' => ''
                ,'content' => '
                    <b>General Information</b><br />
                    <b>Name</b>: General name of the password vault. For example: "Mucikas Machine"<br />
                    <b>Description</b>: Description of the password vault, or any notes about it. For example: ""<br />
                    <br />
                    <b>View Password Vault Information</b>: <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Edit Information</b>: <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Delete</b>: <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />'
            )
            ,"action" => array(
                "Add" => "Add Password Vault"
                ,"Edit" => "Edit Password Vault"
                ,"View" => "View Password Vault"
                ,"Delete" => "Delete Password Vault"
                ,"Upload" => "Upload Attachment to Password Vault"
            )
        )
        ,"Informations/Knowledge" => array(
            "navbar" => "Knowledge Articles"
            ,"fa" => "info"
            ,"title" => "Knowledge Articles"
            ,"help" => "Access to reading/writing/editing knowledge articles (depending on permission level) is available by clicking the 'Companies' button in the menu bar"
            ,"card" => "Click on the card to view knowledge articles"
            ,"info" => array(
                'color' => 'success'
                ,'header' => 'Information'
                ,'addButton' => true
                ,'addNonModal' => false
                ,'title' => ''
                ,'content' => '
                    <b>Important Information!</b><br />
                    When adding a Knowledge Article on the interface, you can provide a title and tags, which will appear in the list.<br />
                    It is advisable to omit the company in the title, as it can be selected from a dropdown list.<br />
                    Commonly used labels for tags:<br />
                    <ul>
                        <li><b>Documentation</b> (relatively all knowledge articles are)</li>
                        <li><b>File</b> (if it has an attachment, or the extension(s) of the file/files)</li>
                        <li><b>Script</b> (if there is a code snippet in the knowledge article)</li>
                        <li><b>Table</b> (if there is any table in the article)</li>
                        <li><b>Email</b> (if there is any email correspondence or details in the article)</li>
                    </ul>
                    The more precise the tagging and titling, the easier the search!
                    <br /> Images and other attachments can be added to the article after its creation using the <b>upload</b> button! <a class="btn btn-warning"><i class="fa fa-upload" aria-hidden="true"></i></a>'
            )
            ,"action" => array(
                "Add" => "Add Knowledge Article"
                ,"Edit" => "Edit Knowledge Article"
                ,"View" => "View Knowledge Article"
                ,"Delete" => "Delete Knowledge Article"
                ,"Upload" => "Upload File to Knowledge Article"
            )
        )
        ,"Informations/Device" => array(
            "navbar" => "Devices"
            ,"fa" => "hdd-o"
            ,"title" => "Device Information"
            ,"help" => "Access to reading/writing/editing device information (depending on permission level) is available by clicking the 'Hardware' button in the menu bar"
            ,"card" => "Click on the card to view device information"
            ,"info" => array(
                'addButton' => true
                ,'addNonModal' => false
                ,'color' => 'success'
                ,'header' => 'Information'
                ,'title' => ''
                ,'content' => '
                    <b>General Information</b><br />
                    <b>Name</b>: General name of the device. For example: "Mucikas Machine"<br />
                    <b>Description</b>: Description of the device, or any notes about it. For example: ""<br />
                    <br />
                    <b>View Device Information</b>: <a class="btn btn-warning btn-sm"><i class="fa fa-th-list" aria-hidden="true"></i></a><br />
                    <b>Edit Information</b>: <a class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a><br />
                    <b>Delete</b>: <a class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a><br />'
            )
            ,"action" => array(
                "Add" => "Add Device"
                ,"Edit" => "Edit Device"
                ,"View" => "View Device"
                ,"Delete" => "Delete Device"
                ,"Upload" => "Upload Attachment to Device"
            )
        )
    );
}
