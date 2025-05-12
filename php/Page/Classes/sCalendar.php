<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{Log, Check, Valid};

use Data\{dCalendar};

use Samples\{sCard, sTables, sTranslate, sForm, sFrame};

class sCalendar
{
    /** @var object $dCombined dCombined class object */
    protected static $dCalendar;

    /** @var const CALENDAR Class constant for dCalendar form elements */
    const CALENDAR = [
        [
            "data" => "eventTitle",
            "desc" => "Esemény neve",
            "type" => "text",
            "tags" => "Add,View,Edit",
            "must-fill" => true,
        ],
        [
            "data" => "eventDescription",
            "desc" => "Esemény leírása", 
            "type" => "text", 
            "tags" => "Add,View,Edit"
        ],
    ];

    /** @var const TYPES Used for getting page specific variables, like form element IDs, form elements, tables */
    const TYPES = [
        "Calendar" => [
            "origo" => "usrCalendar",
            "defaultData" => self::CALENDAR,
            "dbTableId" => "eventId",
        ],
    ];

    /**
     * Sets the class variable : dCalendar
     * @author Liszi Dániel
     */
    protected static function setDCalendar()
    {
        self::$dCalendar = new dCalendar();
    }

    /**
     * Used for events indicated by users
     * @param $array array
     * @return string
     * @author Liszi Dániel
     */
    public static function Action(array $array): string
    {
        $array = array_merge($array, self::TYPES[$array["y"]]);
        $array["origo"] .= $array["z"];
        $array["returnPath"] = ["x" => "Plans", "y" => "Calendar"];
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
        self::setDCalendar();
        $wClass = self::$dCalendar;
        $startDate = date("Y-m-d");
        Log::Export($_POST);
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
                    "constData" => $array["defaultData"],
                    "staticData" => ["origo" => $array["origo"], "tag" => "Add"],
                ]) .
                sForm::Input([
                    "origo" => $array["origo"],
                    "data" => "eventStartDate",
                    "desc" => "Kezdete",
                    "type" => "date",
                    "value" => $startDate,
                    "must-fill" => true,
                ]) .
                sForm::Input([
                    "origo" => $array["origo"],
                    "data" => "eventEndDate",
                    "desc" => "Vége",
                    "type" => "date"
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

    /**
     * Fires Delete action
     * @param $array array
     * @return string
     * @author Liszi Dániel
     */
    public static function Delete(array $array): string
    {
        self::setDCalendar();
        $wClass = self::$dCalendar;
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
