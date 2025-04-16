<?php

declare(strict_types=1);

namespace Page\Actions;

use Toolkit\{Log, Check, Valid};

use Samples\{sForm, sTranslate};

class Users extends \Page\Classes\sAdministrative
{
    public static function Add(array $array): string
    {
        self::setDUser();
        if (!isset($array["Save"])) {
            return '
                <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                    <div class="form-group col p-0">
                        <div class="col-12 row">
                            ' .
                sForm::Input([
                    "origo" => "admUsrsAdd",
                    "data" => "userName",
                    "desc" => "Bejelentkezési név",
                    "value" => "",
                    "type" => "text",
                    "must-fill" => true,
                ]) .
                '
                            ' .
                sForm::Input([
                    "origo" => "admUsrsAdd",
                    "data" => "userContEmail",
                    "desc" => "E-mail cím",
                    "value" => "",
                    "type" => "text",
                    "must-fill" => true,
                ]) .
                '
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 row">
                            <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="admUsrsAdd-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                        </div>
                    </div>
                </form>';
        } else {
            return "<h4>" .
                (self::$dUser->Insert($array)
                    ? sTranslate::ACTION["Success"]["content"]
                    : sTranslate::ACTION["Fail"]["content"]) .
                "</h4>" .
                sForm::Spinner(["x" => "Administrative", "y" => "Users"]);
        }
    }

    public static function Edit(array $array): string
    {
        self::setDGroup();
        self::setDGroup_Member();

        if (!isset($array["Save"])) {
            $selectTag = [];

            foreach (self::$dGroup->Select([], "forMemberEdit") as $i) {
                $selectTag[] = ["id" => $i["groupId"], "name" => $i["groupName"]];
            }
            $Group_Member = self::$dGroup_Member->Select(["userId" => $array["dp"]], "byUserId")[0];

            return '
                <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                    <div class="form-group col p-0">
                        <div class="col-12 row">
                            ' .
                sForm::Input([
                    "origo" => "admMemsEdit",
                    "data" => "groupMemberId",
                    "desc" => "Jogosultsági kör azonosító",
                    "value" => $Group_Member["groupMemberId"],
                    "type" => "hidden",
                ]) .
                '
                            ' .
                sForm::Input([
                    "origo" => "admMemsEdit",
                    "data" => "groupId",
                    "desc" => "Jogosultsági kör",
                    "value" => self::$dGroup_Member->Select(
                        ["groupMemberId" => $Group_Member["groupMemberId"]],
                        "byGroupMemberId"
                    )[0]["groupId"],
                    "select" => $selectTag,
                    "type" => "select",
                ]) .
                '
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12 row">
                            <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="admMemsEdit-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                        </div>
                    </div>
                </form>';
        } else {
            return "<h4>" .
                (self::$dGroup_Member->Update($array, "byGroupMemberId")
                    ? sTranslate::ACTION["Success"]["content"]
                    : sTranslate::ACTION["Fail"]["content"]) .
                "</h4>" .
                sForm::Spinner(["x" => "Administrative", "y" => "Users"]);
        }
        return "Edit, dp: " . $array["dp"];
    }

    public static function Reset(array $array): string
    {
        self::setDUser();

        if (!isset($array["Save"])) {
            return '<form method="post" class="form-group col-12 m-0 p-0" autocomplete="on">
                    <div class="form-group col m-0 p-0">
                    <div class="col-12 row m-0 p-0">' .
                sForm::Input([
                    "origo" => "admUsrPass",
                    "data" => "userId",
                    "desc" => "Id",
                    "value" => $array["dp"],
                    "type" => "hidden",
                ]) .
                sForm::Input([
                    "origo" => "admUsrPass",
                    "data" => "pWord",
                    "desc" => "Új jelszó",
                    "value" => "",
                    "type" => "password",
                    "must-fill" => true,
                ]) .
                '</div>
                </div>
                <hr />
                <div class="form-group">
                    <div class="col-12 row">
                        <button class="btn btn-lg btn-success col-12 col-md-6" type="submit" id="admUsrPass-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                    </div>
                </div>
            </form>';
        } else {
            return "<h4>" .
                (self::$dUser->Update($array, "Reset")
                    ? sTranslate::ACTION["Success"]["content"]
                    : sTranslate::ACTION["Fail"]["content"]) .
                "</h4>" .
                sForm::Spinner(["x" => "Administrative", "y" => "Users"]);
        }
    }

    public static function Delete(array $array): string
    {
        self::setDUser();
        return "<h4>" .
            (self::$dUser->Update(
                [
                    "userId" => (int) $array["dp"],
                    "groupId" => (int) $GLOBALS["Data"]["groupDelete"],
                ],
                "Delete"
            )
                ? sTranslate::ACTION["Success"]["content"]
                : sTranslate::ACTION["Fail"]["content"]) .
            "</h4>" .
            sForm::Spinner(["x" => "Administrative", "y" => "Users"]);
    }
}
?>
