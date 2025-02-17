<?php

declare(strict_types=1);

namespace Samples\sTables;

interface SRP_DP
{
    const SRP_DP = array(
        "tableId" => "tableCapMngmtSRP",
        "tableRoot" => "SRP",
        "data" => array(
            "symid" => array("text" => "Sym Id", "tooltip" => "")
            ,"srp_id" => array("text" => "SRP Id", "tooltip" => "")
            ,"name" => array("text" => "Megnvezés", "tooltip" => "")
            ,"usable_capacity" => array("text" => "Kapacitás", "tooltip" => "")
        ),
        "button" => array(
             array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
        )
    );
}
?>