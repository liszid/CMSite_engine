<?php

declare(strict_types=1);

namespace Page\Actions;

use Toolkit\{Log, Check, Valid};

use Samples\{sForm, sTranslate};

class Huntgroups extends \Page\Classes\sAdministrative
{
    public static function Add(array $array): string
    {
        self::setDHuntgroup();
        if (!isset($array["Save"])) {
            return '
                <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                    <div class="form-group col p-0">
                        <div class="col-12 row">
                            ' .
                sForm::Input([
                    "origo" => "admHuntgroupsAdd",
                    "data" => "huntgroupName",
                    "desc" => "Név",
                    "value" => "",
                    "type" => "text",
                    "must-fill" => true,
                ]) .
                '
                            ' .
                sForm::Input([
                    "origo" => "admHuntgroupsAdd",
                    "data" => "huntgroupDesc",
                    "desc" => "Leírás",
                    "value" => "",
                    "type" => "text",
                ]) .
                '
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 row">
                            <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="admHuntgroupsAdd-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                        </div>
                    </div>
                </form>';
        } else {
            return "<h4>" .
                (self::$dHuntgroup->Insert($array)
                    ? sTranslate::ACTION["Success"]["content"]
                    : sTranslate::ACTION["Fail"]["content"]) .
                "</h4>" .
                sForm::Spinner(["x" => "Administrative", "y" => "Huntgroups"]);
        }
    }

    public static function Edit(array $array): string
    {
        self::setDHuntgroup();
        if (!isset($array["Save"])) {
            $Huntgroup = self::$dHuntgroup->Select(["huntgroupId" => (int) $array["dp"]], "byHuntgroupId")[0];
            return '
                <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                    <div class="form-group col p-0">
                        <div class="col-12 row">' .
                sForm::Input([
                    "origo" => "admHuntgroupsEdit",
                    "data" => "huntgroupId",
                    "desc" => "Id",
                    "value" => $Huntgroup["huntgroupId"],
                    "type" => "hidden",
                ]) .
                sForm::Input([
                    "origo" => "admHuntgroupsEdit",
                    "data" => "huntgroupName",
                    "desc" => "Név",
                    "value" => $Huntgroup["huntgroupName"],
                    "type" => "text",
                    "must-fill" => true,
                ]) .
                sForm::Input([
                    "origo" => "admHuntgroupsEdit",
                    "data" => "huntgroupDesc",
                    "desc" => "Leírás",
                    "value" => $Huntgroup["huntgroupDesc"],
                    "type" => "text",
                ]) .
                self::Prompt_Checkbox($array) .
                '</div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 row">
                            <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="admHuntgroupsEdit-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                        </div>
                    </div>
                </form>';
        } else {
            return "<h4>" .
                (self::$dHuntgroup->Update($array)
                    ? sTranslate::ACTION["Success"]["content"]
                    : sTranslate::ACTION["Fail"]["content"]) .
                "</h4>" .
                sForm::Spinner(["x" => "Administrative", "y" => "Huntgroups"]);
        }
    }

    public static function View(array $array): string
    {
        self::setDHuntgroup();
        $Huntgroup = self::$dHuntgroup->Select(["huntgroupId" => (int) $array["dp"]], "byHuntgroupId")[0];

        return '
            <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                <div class="form-group col p-0">
                    <div class="col-12 row">
                        ' .
            sForm::Input([
                "origo" => "admHuntgroupsView",
                "data" => "huntgroupId",
                "desc" => "Id",
                "value" => $Huntgroup["huntgroupId"],
                "type" => "hidden",
            ]) .
            '
                        ' .
            sForm::Input([
                "origo" => "admHuntgroupsView",
                "data" => "huntgroupName",
                "desc" => "Név",
                "value" => $Huntgroup["huntgroupName"],
                "type" => "text",
                "disabled" => true,
            ]) .
            '
                        ' .
            sForm::Input([
                "origo" => "admHuntgroupsView",
                "data" => "huntgroupDesc",
                "desc" => "Leírás",
                "value" => $Huntgroup["huntgroupDesc"],
                "type" => "text",
                "disabled" => true,
            ]) .
            '
                        ' .
            self::Prompt_Checkbox($array, true) .
            '
                    </div>
                </div>
            </form>';
    }

    private static function Prompt_Checkbox(array $array, bool $bool = false): string
    {
        self::setDUser();
        self::setDCombined();

        $AllUsers = self::$dUser->Select([], "All");
        $HGUsers = self::$dCombined->Select(["huntgroupId" => (int) $array["dp"]], "Huntgroup_Members");
        $returnString =
            '
        <div class="form-group col-12 h-100">
            <label for="admHuntgroups' .
            ($bool ? "View" : "Edit") .
            '">Felhasználók</label>
            <select multiple size="10"' .
            ($bool ? " disabled" : "") .
            ' class="form-control" id="admHuntgroupsEdit-userCheckbox">
        ';

        foreach ($AllUsers as $i) {
            $returnString .=
                '
                <option' .
                (!is_null($HGUsers) && array_search($i["userId"], array_column($HGUsers, "userId")) !== false
                    ? " selected"
                    : "") .
                ' value="' .
                $i["userId"] .
                '">
                    ' .
                $i["userName"] .
                '
                </option>';
        }

        $returnString .= '
            </select>
          </div>
        ';

        return $returnString;
    }

    public static function Delete(array $array): string
    {
        self::setDHuntgroup();

        return "<h4>" .
            (self::$dHuntgroup->Delete([
                "huntgroupId" => $array["dp"],
            ])
                ? sTranslate::ACTION["Success"]["content"]
                : sTranslate::ACTION["Fail"]["content"]) .
            "</h4>" .
            sForm::Spinner(["x" => "Administrative", "y" => "Huntgroups"]);
    }
}
?>
