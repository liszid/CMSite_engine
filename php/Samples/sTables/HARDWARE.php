<?php

declare(strict_types=1);

namespace Samples\sTables;

interface HARDWARE
{
    const HARDWARE_DEFAULT = array(
        "hardwareId" => array("text" => "Id", "tooltip" => "")
        ,"hardwareName" => array("text" => "Név", "tooltip" => "Eszköz neve")
        ,"hardwareDesc" => array("text" => "Leírás", "tooltip" => "Eszköz leírása")
        ,"hardwarePrice" => array("text" => "Ár", "tooltip" => "Beszerzési ár")
        ,"hardwareDateIn" => array("text" => "Beszerzés", "tooltip" => "Beszerzés dátuma")
        ,"hardwareGuaranteeDate" => array("text" => "Garancia", "tooltip" => "Garancia ideje")
    );

    const HARDWARE_BUTTONS = array(
        array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
        ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 3)
        ,array('color' => 'warning', 'fa' => 'upload', 'action' => 'Upload', 'tooltip' => 'Feltöltés', 'level' => 3)
        ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 7)
    );

    const HARDWARE_DEVICE= array(
        "tableId" => "tableInformationsDevice"
        ,"tableRoot" => "Informations/Device"
        ,"tableRole" => "canHardware"
        ,"data" => self::HARDWARE_DEFAULT
        ,"button" => self::HARDWARE_BUTTONS
    );

}
