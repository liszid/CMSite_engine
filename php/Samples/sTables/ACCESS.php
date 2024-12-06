<?php

declare(strict_types=1);

namespace Samples\sTables;

interface ACCESS
{
    const ACCESS_ACCESS = array(
        "tableId" => "tableAccessAccess",
        "tableRoot" => "Informations/Access",
        "tableRole" => "canAccess",
        "data" => array(
            "accessId" => array("text" => "Id", "tooltip" => "")
            ,"passtorageName" => array("text" => "Név", "tooltip" => "Eszköz neve")
            ,"accessLabel" => array("text" => "Cimke", "tooltip" => "Hozzáférési cimke", "link" => "accessLink")
            ,"accessUsername" => array("text" => "Felhasználó", "tooltip" => "Felhasználóinév")
        ),
        "button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 3)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 7)
        )
    );
}
