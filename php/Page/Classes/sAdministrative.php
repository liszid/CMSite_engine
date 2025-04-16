<?php
declare(strict_types=1);
namespace Page\Classes;

use Toolkit\{Log, Check, Valid};
use Data\{dUser, dGroup, dGroup_Member, dHuntgroup, dHuntgroup_Member, dCombined};
use Samples\{sCard, sTables, sTranslate, sForm};

class sAdministrative
{
    protected static $dUser;
    protected static $dGroup;
    protected static $dGroup_Member;
    protected static $dHuntgroup;
    protected static $dHuntgroup_Member;
    protected static $dCombined;

    protected static function setDUser()
    {
        self::$dUser = new dUser();
    }

    protected static function setDGroup()
    {
        self::$dGroup = new dGroup();
    }

    protected static function setDGroup_Member()
    {
        self::$dGroup_Member = new dGroup_Member();
    }

    protected static function setDHuntgroup()
    {
        self::$dHuntgroup = new dHuntgroup();
    }

    protected static function setDHuntgroup_Member()
    {
        self::$dHuntgroup_Member = new dHuntgroup_Member();
    }

    protected static function setDCombined()
    {
        self::$dCombined = new dCombined();
    }

    public static function Action(array $array): string
    {
        $classIdentifier = "\\Page\\Actions\\" . $array["y"];
        $wclass = new $classIdentifier();
        $returnContent = $wclass->{$array["z"]}($array);

        if (Valid::vString($returnContent)) {
            $returnContent = '<div class="text-center justification-centered">' . $returnContent . "</div>";
        }

        return $returnContent;
    }

    public static function Users(array $array): string
    {
        self::setDCombined();

        $returnString = "";
        $Users = self::$dCombined->Select([], "Member_Full");

        if (isset($array["path"])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array["path"]));
        }

        $returnString .= sTables::Prompt($Users, "ADMIN_USERS");
        return $returnString;
    }

    public static function Groups(array $array): string
    {
        self::setDGroup();

        $returnString = "";
        $Groups = self::$dGroup->Select([], "All");

        if (Valid::vString($array["path"])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array["path"]));
        }

        $returnString .= sTables::Prompt($Groups, "ADMIN_GROUPS");
        return $returnString;
    }

    public static function Huntgroups(array $array): string
    {
        self::setDHuntgroup();

        $returnString = "";
        $Huntgroups = self::$dHuntgroup->Select([], "All");

        if (Valid::vString($array["path"])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array["path"]));
        }

        $returnString .= sTables::Prompt($Huntgroups, "ADMIN_HUNTGROUPS");
        return $returnString;
    }

    public static function Tools(array $array): string
    {
        $returnString = "";
        $nestedPages = ["Logs"];

        if (isset($_POST["c"]) && in_array($_POST["c"], $nestedPages)) {
            $wclass = new \Page\Actions\Tools();

            switch ($_POST["c"]) {
                case "Logs":
                    $returnString .= $wclass::Logs($array);
                    break;
            }
        } else {
            if (Valid::vString($array["path"])) {
                $returnString .=
                    sCard::Collapsible(sTranslate::Info($array["path"])) .
                    '<div class="card-columns m-2">' .
                    sCard::Blank([
                        "color" => "secondary",
                        "title" => "Felhasználói események",
                        "button" => sForm::Button([
                            "color" => "success",
                            "fa" => "search",
                            "text" => " Megtekintés",
                            "path" => $array["path"] . "/Logs",
                            "nonModal" => true,
                        ]),
                    ]) .
                    "</div>";
            }
        }

        return $returnString;
    }
}
?>
