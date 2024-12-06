<?php

declare(strict_types=1);

namespace Samples\sTables;

interface PASSTORAGE
{
    const PASSTORAGE_DEFAULT = array(
        "passtorageId" => array("text" => "Id", "tooltip" => "")
        ,"passtorageName" => array("text" => "Név", "tooltip" => "Jelszótároló neve")
        ,"passtorageDesc" => array("text" => "Leírás", "tooltip" => "Jelszótároló leírása")
        ,"passtorageDate" => array("text" => "Hozzáadva", "tooltip" => "Hozzáadva")
    );

    const PASSTORAGE_PC = array(
        "passtorageId" => array("text" => "Id", "tooltip" => "")
        ,"passtorageName" => array("text" => "Név", "tooltip" => "Jelszótároló neve")
        ,"passtorageDesc" => array("text" => "Leírás", "tooltip" => "Jelszótároló leírása")
        ,"passtorageDate" => array("text" => "Hozzáadva", "tooltip" => "Hozzáadva")
    );

    const PASSTORAGE_BUTTONS = array(
        array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
        ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 3)
        ,array('color' => 'warning', 'fa' => 'upload', 'action' => 'Upload', 'tooltip' => 'Feltöltés', 'level' => 3)
        ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 7)
    );

    const PASSTORAGE_LAPTOP = array(
        "tableId" => "tableInformationsPasstorage"
        ,"tableRoot" => "Informations/Passtorage"
        ,"tableRole" => "canPasstorage"
        ,"data" => self::PASSTORAGE_PC
        ,"button" => self::PASSTORAGE_BUTTONS
    );

}
