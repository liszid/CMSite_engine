<?php

declare(strict_types=1);

use Toolkit\{Log, Check, Valid};
use Data\{dUser, dCombined};
use Samples\{sFrame, sForm, sProfile, sRedirect, sTranslate};

if (isset($sessionUsr["userId"])) {
    $dUser = new dUser();
    $dCombined = new dCombined();
    $urlPaths = [
        "Root" => "Profile",
    ];

    if (isset($_POST["Save"]) && (int) $sessionUsr["canEdit"] > 0) {
        $returnText = sTranslate::ACTION["Fail"]["content"];

        if ($dUser::Update($_POST, Check::isPost("y"))) {
            $returnText = sTranslate::ACTION["Success"]["content"];
        }

        $returnContent =
            '
                <div class="text-center justification-centered">
                    <h4>' .
            $returnText .
            '</h4>
                    ' .
            sForm::Spinner(["x" => "Profile", "reload" => true]) .
            '
                </div>';

        echo sFrame::Modal(["path" => "Profile", "content" => $returnContent]);
    } elseif (isset($_POST["x"]) && !strcmp($_POST["x"], "Profile")) {
        $User = $dCombined->Select($sessionUsr, "User_Full")[0];
        $User["Huntgroups"] = $dCombined->Select($sessionUsr, "User_Huntgroups");

        $modalText = "";

        if (isset($_POST["dp"])) {
            $modalText = sProfile::Prompt($User, $_POST["dp"]);
        } else {
            $modalText = sProfile::Prompt($User, "Self");
        }

        $modalBody =
            '
            <div class="container bootstrap snippet">
                <div class="row">
                    <div class="col-md-12">
                        ' .
            $modalText .
            '
                    </div>
                </div>
            </div>';
        echo sFrame::Modal(["path" => $urlPaths["Root"], "content" => $modalBody]);
    } else {
        echo sRedirect::Home();
    }
} else {
    echo sRedirect::Home();
}
?>