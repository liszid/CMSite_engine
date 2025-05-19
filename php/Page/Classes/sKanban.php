<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{Log, Check, Valid};

use Data\{dKanban, dKanbanType};

use Samples\{sCard, sTables, sTranslate, sForm, sFrame};

class sKanban
{
    /** @var object $dCombined dCombined class object */
    protected static $dKanban;
    protected static $dKanbanType;

    /** @var const CALENDAR Class constant for dCalendar form elements */
    const KANBAN = [
        ["data" => "kanbanId", "desc" => "", "type" => "hidden", "tags" => "Edit"],
        ["data" => "kanbanTypeId", "desc" => "Állapot", "type" => "selectpicker", "tags" => "Add,Edit"],
        ["data" => "kanbanTitle", "desc" => "Cím", "type" => "text", "tags" => "Add,Edit", "must-fill" => true],
        ["data" => "kanbanText", "desc" => "Leírás", "type" => "hidden", "print" => true, "tags" => "Add,View,Edit"],
    ];

    /** @var const TYPES Used for getting page specific variables, like form element IDs, form elements, tables */
    const TYPES = [
        "Kanban" => [
            "origo" => "usrKanban",
            "defaultData" => self::KANBAN,
            "tableName" => "KANBAN",
            "dbTableId" => "kanbanId",
            "tableQuery" => "All",
        ],
    ];

    /**
     * Sets the class variable : dCalendar
     * @author Liszi Dániel
     */
    protected static function setDKanban()
    {
        self::$dKanban = new dKanban();
    }

    protected static function setDKanbanType()
    {
        self::$dKanbanType = new dKanbanType();
    }

    public static function Page(array $array): string
    {
        self::setDKanban();
        $returnString = "";
        $fQuery = "All";
        $fClass = !empty($fQuery) ? self::$dKanban->Select(["userId" => $GLOBALS["sessionId"]], $fQuery) : "";
        if (isset($array["path"])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array["path"]));
        }
        $returnString .= sTables::Prompt($fClass, self::TYPES["Kanban"]["tableName"]);

        return $returnString;
    }

    protected static function KanbanTypeSelect(): array
    {
        self::setDKanbanType();
        $tempArray = [];
        foreach (self::$dKanbanType->Select([], "List") as $i) {
            $tempArray[] = ["id" => $i["kanbanTypeId"], "name" => $i["kanbanTypeList"]];
        }
        return $tempArray;
    }
    /**
     * Used for events indicated by users
     * @param $array array
     * @return string
     * @author Liszi Dániel
     */
    public static function Action(array $array): string
    {
        $array = array_merge($array, self::TYPES["Kanban"]);
        $array["origo"] .= $array["z"];
        $array["returnPath"] = ["x" => "Plans", "y" => "Kanban"];
        $returnContent = self::{$array["z"]}($array);

        if (Valid::vString($returnContent)) {
            $returnContent = '<div class="text-center justification-centered">' . $returnContent . "</div>";
        }

        return $returnContent;
    }

    /**
     * Returns Adding form
     * @param $array array
     * @return string
     * @author Liszi Dániel
     */
    public static function Add(array $array): string
    {
        self::setDKanban();
        $wClass = self::$dKanban;
        if (!isset($array["Save"])) {
            return '
                <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                    <div class="form-group col p-0">
                        <div class="col-12 row">' .
                sForm::Input([
                    "origo" => $array["origo"],
                    "data" => "userId",
                    "desc" => "",
                    "value" => $GLOBALS["sessionId"],
                    "type" => "hidden",
                ]) .
                sForm::Generate([
                    "constData" => self::KANBAN,
                    "staticData" => ["origo" => $array["origo"], "tag" => "Add"],
                    "selectData" => ["kanbanTypeId" => self::KanbanTypeSelect()],
                ]) .
                '</div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 row">
                            <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="' .
                $array["origo"] .
                '-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                        </div>
                    </div>
                </form>';
        } else {
            return "<h4>" .
                ($wClass->Insert($array)
                    ? sTranslate::ACTION["Success"]["content"]
                    : sTranslate::ACTION["Fail"]["content"]) .
                "</h4>" .
                sForm::Spinner($array["returnPath"]);
        }
    }

    public static function View(array $array): string
    {
        self::setDKanban();
        $Kanban = self::$dKanban->Select(["kanbanId" => (int) $array["dp"]], "byId")[0];
        return '
                    <form method="post" class="text-left form-group col-12 p-0 m-0" autocomplete="on">
                        <div class="form-group col p-0">
                            <div class="col-12 row">' .
            sForm::Generate([
                "constData" => self::KANBAN,
                "staticData" => ["origo" => $array["origo"], "tag" => "View"],
                "selectData" => [
                    "kanbanTypeId" => self::KanbanTypeSelect(),
                ],
                "valueData" => $Kanban,
            ]) .
            '</div>
                        </div>
                    </form>';
    }

    public static function Edit(array $array): string
    {
        self::setDKanban();
        if (!isset($array["Save"])) {
            $Kanban = self::$dKanban->Select(["kanbanId" => (int) $array["dp"]], "byId")[0];

            return '
                        <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on" enctype="multipart/form-data">
                            <div class="form-group col p-0">
                                <div class="col-12 row">' .
                sForm::Input([
                    "origo" => $array["origo"],
                    "data" => "userId",
                    "desc" => "",
                    "value" => $GLOBALS["sessionId"],
                    "type" => "hidden",
                ]) .
                sForm::Generate([
                    "constData" => self::KANBAN,
                    "staticData" => ["origo" => $array["origo"], "tag" => "Edit"],
                    "selectData" => [
                        "kanbanTypeId" => self::KanbanTypeSelect(),
                    ],
                    "valueData" => $Kanban,
                ]) .
                '</div>
                            </div>
                            <div class="form-group">
                                <div class="col-12 row">
                                    <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="' .
                $array["origo"] .
                '-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                                </div>
                            </div>
                        </form>';
        } else {
            return "<h4>" .
                (self::$dKanban->Update($array)
                    ? sTranslate::ACTION["Success"]["content"]
                    : sTranslate::ACTION["Fail"]["content"]) .
                "</h4>" .
                sForm::Spinner($array["returnPath"]);
        }
    }

    /**
     * Fires Delete action
     * @param $array array
     * @return string
     * @author Liszi Dániel
     */
    public static function Delete(array $array): string
    {
        self::setDKanban();
        $wClass = self::$dKanban;
        return "<h4>" .
            ($wClass->Delete([
                $array["dbTableId"] => (int) $array["dp"],
                "userId" => $GLOBALS["sessionId"],
            ])
                ? sTranslate::ACTION["Success"]["content"]
                : sTranslate::ACTION["Fail"]["content"]) .
            "</h4>" .
            sForm::Spinner($array["returnPath"]);
    }
}
?>
