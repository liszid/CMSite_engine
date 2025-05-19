<?php

declare(strict_types=1);

use Toolkit\{Log, Check, Valid};

use Samples\{sCard, sBreadcrumbs, sFrame, sRedirect};

use Samples\sCalendar as CalDisplay;

use Page\Classes\{sCalendar, sKanban};

if (isset($sessionUsr["userId"]) && (int) $sessionUsr["canLogin"] > 0) {
    /** @var array $returnArray It stores the content to be displayed */
    $returnArray = [];
    /** @var array $urlPaths Routing assistant variable */
    $urlPaths = [
        "Root" => ["path" => "Plans", "role" => "canLogin"],
        "Calendar" => ["path" => "Plans/Calendar", "role" => "canLogin"],
        "Kanban" => ["path" => "Plans/Kanban", "role" => "canLogin"],
    ];
    /** @var array $nonModal Indicates which actions should be shown as is */
    $nonModal = [];
    /** @var array $printView Sets actions to get print view */
    $printView = [];
    /** Post action handling and form prompt section */
    if (isset($_POST["y"]) && isset($_POST["z"])) {
        if (Valid::vString(Check::isPost("y")) && Valid::vString(Check::isPost("z"))) {
            $returnArray["path"] = $urlPaths[Check::isPost("y")]["path"] . "/" . Check::isPost("z");
            $returnArray["content"] = '';
            switch ($_POST["y"]) {
                case "Calendar":
                    $returnArray["content"] =sCalendar::Action($_POST);
                        break;
                case "Kanban":
                    $returnArray["content"] =sKanban::Action($_POST);
                        break;
            }
        }
        /**
         * Printable section
         */
        if (Valid::vString($returnArray["content"])) {
            if (in_array(Check::isPost("z"), $nonModal)) {
                echo $returnArray["content"];
            } else {
                if (in_array(Check::isPost("z"), $printView)) {
                    $returnArray["print"] = true;
                }
                echo sFrame::Modal($returnArray);
            }
        } else {
            echo sRedirect::Home();
        }
        /**
         * Page loading section
         */
    } elseif (isset($_POST["y"]) || isset($_POST["b"])) {
        $postUrl = Check::isEither(["post" => ["y", "b"], "fallBack" => "Calendar"]);
        $returnArray["path"] = $urlPaths[$postUrl]["path"];
        $returnArray["content"] = '';
        switch ($postUrl) {
            case "Calendar":
                $returnArray["content"] =
                    (int) $sessionUsr[$urlPaths[$postUrl]["role"]] > 0 ? CalDisplay::Display($returnArray) : "";
                    break;
            case "Kanban":
                $returnArray["content"] =
                    (int) $sessionUsr[$urlPaths[$postUrl]["role"]] > 0 ? sKanban::Page($returnArray) : "";
                    break;
        }
        echo isset($returnArray["content"]) ? sFrame::Page($returnArray) : sRedirect::Home();
        /**
         * Collective page with Cards
         */
    } else {
        $returnArray["path"] = $urlPaths["Root"]["path"];
        $returnArray["content"] = '<div class="card-columns m-2">';

        foreach ($urlPaths as $key => $value) {
            if (strcmp(array_key_first($urlPaths), $key)) {
                if (isset($value["role"]) && (int) $sessionUsr[$value["role"]] > 0) {
                    $returnArray["content"] .= sCard::Translated($value["path"], "Linked");
                }
            }
        }

        $returnArray["content"] .= "</div>";

        echo sFrame::Page($returnArray);
    }
} else {
    echo sRedirect::Home();
}

?>
