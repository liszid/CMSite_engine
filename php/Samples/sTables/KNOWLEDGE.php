<?php

declare(strict_types=1);

namespace Samples\sTables;

interface KNOWLEDGE
{
    const KNOWLEDGE_KNOWLEDGE = array(
        "tableId" => "tableKnowledgeKnowledge"
        ,"tableRoot" => "Informations/Knowledge"
        ,"tableRole" => "canKnowledge"
        ,"data" => array(
            "knowledgeId" => array("text" => "Id", "tooltip" => "")
            ,"knowledgeTitle" => array("text" => "Cím", "tooltip" => "Cím")
//          ,"knowledgeTypeName" => array("text" => "Típus", "tooltip" => "Típus")
            ,"knowledgeLabel" => array("text" => "Címkék", "tooltip" => "Címkék")
    		,"companyName" => array("text" => "Cég", "tooltip" => "Cég")
            ,"knowledgeDate" => array("text" => "Dátum", "tooltip" => "Dátum")
        )
        ,"button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
            ,array('color' => 'warning', 'fa' => 'pencil', 'action' => 'Edit', 'tooltip' => 'Szerkesztés', 'level' => 3)
            ,array('color' => 'warning', 'fa' => 'upload', 'action' => 'Upload', 'tooltip' => 'Feltöltés', 'level' => 3)
            ,array('color' => 'danger', 'fa' => 'trash', 'action' => 'Delete', 'tooltip' => 'Törlés', 'level' => 7)
        )
    );
}
