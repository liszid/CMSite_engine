<?php

declare(strict_types=1);

namespace Samples\sTables;

interface ADMIN
{
    const ADMIN_GROUPS = array(
        "tableId" => "tableAdminGroups"
        ,"tableRoot" => "Administrative/Groups"
        ,"tableRole" => "mngGroups"
        ,"data" => array(
            "groupId" => array("text" => "Id", "tooltip" => "")
            ,"groupName" => array("text" => "Név", "tooltip" => "")
            ,"groupDesc" => array("text" => "Leírás", "tooltip" => "")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 1)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 1)
        )
    );

    const ADMIN_HUNTGROUPS = array(
        "tableId" => "tableAdminHuntgroups"
        ,"tableRoot" => "Administrative/Huntgroups"
        ,"tableRole" => "mngHuntgroups"
        ,"data" => array(
            "huntgroupId" => array("text" => "Id", "tooltip" => "")
            ,"huntgroupName" => array("text" => "Név", "tooltip" => "")
            ,"huntgroupDesc" => array("text" => "Leírás", "tooltip" => "")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 1)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 1)
        )
    );

    const ADMIN_MEMBERSHIP = array(
        "tableId" => "tableAdminMembership"
        ,"tableRoot" => "Administrative/Membership"
        ,"tableRole" => "mngMembers"
        ,"data" => array(
            "groupMemberId" => array("text" => "Id", "tooltip" => "")
            ,"groupName" => array("text" => "Jogosultság", "tooltip" => "")
            ,"groupDesc" => array("text" => "Jogosultság leírás", "tooltip" => "")
            ,"userName" => array("text" => "Felhasználónév", "tooltip" => "")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 1)
        )
    );

    const ADMIN_USERS = array(
        "tableId" => "tableAdminUsers"
        ,"tableRoot" => "Administrative/Users"
        ,"tableRole" => "mngUsers"
        ,"data" => array(
            "userId" => array("text" => "Id", "tooltip" => "")
            ,"userName" => array("text" => "Felhasználó", "tooltip" => "")
            ,"groupName" => array("text" => "Jogosultság", "tooltip" => "")
            ,"groupDesc" => array("text" => "Jogosultság leírás", "tooltip" => "")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Jogosultság kör módosítása', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'undo', 'action' => 'Reset', 'tooltip' => 'Jelszó helyreállítás', 'level' => 1)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Fiók töröltté állítása', 'level' => 1)
        )
    );

    const ADMIN_LOGS = array(
        "tableId" => "tableAdminLogs"
        ,"tableRoot" => "Administrative/Logs"
        ,"tableRole" => "mngTools"
        ,"data" => array(
            "logId" => array("text" => "Id", "tooltip" => "")
            ,"logAction" => array("text" => "Action", "tooltip" => "")
            ,"logCategory" => array("text" => "Category", "tooltip" => "")
            ,"logText" => array("text" => "Text", "tooltip" => "")
            ,"userName" => array("text" => "UserName", "tooltip" => "")
            ,"logDate" => array("text" => "Date", "tooltip" => "")
        )
        ,"button" => array()
    );

    const ADMIN_COMPANY_SITE_TYPE = array(
        "tableId" => "tableAdminCompanySiteType"
        ,"tableRoot" => "Administrative/Tools/Company_Site_Type"
        ,"tableRole" => "mngTools"
        ,"data" => array(
            "companySiteTypeId" => array("text" => "Id", "tooltip" => "")
            ,"companySiteTypeName" => array("text" => "Megnevezés", "tooltip" => "")
            ,"companySiteTypeDate" => array("text" => "Dátum", "tooltip" => "")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 1)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 1)
        )
    );

    const ADMIN_KNOWLEDGE_TYPE = array(
        "tableId" => "tableAdminKnowledgeType"
        ,"tableRoot" => "Administrative/Tools/Knowledge_Type"
        ,"tableRole" => "mngTools"
        ,"data" => array(
            "knowledgeTypeId" => array("text" => "Id", "tooltip" => "")
            ,"knowledgeTypeName" => array("text" => "Megnevezés", "tooltip" => "")
            ,"knowledgeTypeDate" => array("text" => "Dátum", "tooltip" => "")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 1)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 1)
        )
    );
}
