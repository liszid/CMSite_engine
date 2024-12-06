<?php

declare(strict_types=1);

namespace Samples\sTables;

interface COMPANY
{
    const COMPANY_COMPANY = array(
        "tableId" => "tableCompanyCompany"
        ,"tableRoot" => "Company/Company"
        ,"tableRole" => "canCompany"
        ,"data" => array(
            "companyId" => array("text" => "Id", "tooltip" => "")
            ,"companyName" => array("text" => "Név", 'action' => 'Filter2Company')
            ,"companyDesc" => array("text" => "Leírás", "tooltip" => "Cég leírása")
            ,"companyTaxNumber" => array("text" => "Adószám", "tooltip" => "Cég adószáma")
            ,"companyRegisteredNumber" => array("text" => "Cégjegyzékszám", "tooltip" => "Cégjegyzékszám")
            ,"companyAddressCity" => array("text" => "Város", "tooltip" => "Cég központ címe: Város")
            ,"companyAddressPostcode" => array("text" => "IRSZ", "tooltip" => "Cég központ címe: Irányítószám")
            ,"companyAddressStreet" => array("text" => "Utca", "tooltip" => "Cég központ címe: Utca, házszám")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 3)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 7)
        )
    );

    const COMPANY_SITE = array(
        "tableId" => "tableCompanySite"
        ,"tableRoot" => "Company/Site"
        ,"tableRole" => "canCompany"
        ,"data" => array(
            "companySiteId" => array("text" => "Id", "tooltip" => "")
            ,"companyName" => array("text" => "Cég név", 'action' => 'Filter2Company')
            ,"companySiteName" => array("text" => "T.hely név", "tooltip" => "Telephely neve")
            ,"companySiteTypeName" => array("text" => "T.hely típus", "tooltip" => "Telephely típusa")
            ,"companySiteAddressCity" => array("text" => "Város", "tooltip" => "Telephely címe: Város")
            ,"companySiteAddressPostcode" => array("text" => "IRSZ", "tooltip" => "Telephely címe: Irányítószám")
            ,"companySiteAddressStreet" => array("text" => "Utca", "tooltip" => "Telephely címe: Utca, házszám")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 3)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 7)
        )
    );

    const COMPANY_FILTER_COMPANY_SITE = array(
        "tableId" => "tableCompanyFilterCompanySite"
        ,"tableRoot" => "Company/Site"
        ,"tableRole" => "canCompany"
        ,"data" => array(
            "companySiteId" => array("text" => "Id", "tooltip" => "")
            ,"companySiteName" => array("text" => "Név", "tooltip" => "Telephely neve")
            ,"companySiteTypeName" => array("text" => "Típus", "tooltip" => "Telephely típusa")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 3)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 7)
        )
    );

    const COMPANY_FILTER_PASSTORAGE = array(
        "tableId" => "tableCompanyFilterPasstorage"
        ,"tableRoot" => "Informations/Passtorage"
        ,"tableRole" => "canPasstorage"
        ,"data" => array(
            "passtorageId" => array("text" => "Id", "tooltip" => "")
            ,"passtorageName" => array("text" => "Név", "tooltip" => "Eszköz neve")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 3)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 7)
        )
    );

    const COMPANY_FILTER_DEVICE = array(
        "tableId" => "tableCompanyFilterDevice"
        ,"tableRoot" => "Informations/Device"
        ,"tableRole" => "canPasstorage"
        ,"data" => array(
            "hardwareId" => array("text" => "Id", "tooltip" => "")
            ,"hardwareName" => array("text" => "Név", "tooltip" => "Eszköz neve")
            ,"hardwareDesc" => array("text" => "Típus", "tooltip" => "Eszköz típusa")
            ,"hardwareDateIn" => array("text" => "Típus", "tooltip" => "Eszköz típusa")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 3)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 7)
        )
    );
    
    const COMPANY_FILTER_KNOWLEDGE = array(
        "tableId" => "tableCompanyFilterKnowledge"
        ,"tableRoot" => "Informations/Knowledge"
        ,"tableRole" => "canKnowledge"
        ,"data" => array(
            "knowledgeId" => array("text" => "Id", "tooltip" => "")
            ,"knowledgeTitle" => array("text" => "Cím", "tooltip" => "Tudáscikk címe")
            ,"knowledgeDate" => array("text" => "Dátum", "tooltip" => "Hozzáadás dátuma")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 3)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 7)
        )
    );

}
