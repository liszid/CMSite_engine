<?php

declare(strict_types=1);

use Toolkit\{Log, Check, Valid};
use Samples\{sFrame, sForm, sRedirect, sTranslate};
use Data\{dUser, dCombined};

if (!Valid::vArray($sessionUsr)) {
	$urlPaths = ["Root" => "Login"];
	if (isset($_POST["Login"])) {
		$dUser = new dUser();
		$dCombined = new dCombined();
		$selectLogin = $dUser->Select($_POST, "Login");
		$returnText = sTranslate::ACTION["Fail"]["content"];
		if (isset($selectLogin[0]) && Valid::vArray($selectLogin[0])) {
			$userVar = $dCombined->Select($selectLogin[0], "User_Full");
			if (isset($userVar[0]) && Valid::vArray($userVar[0])) {
				if ($userVar[0]["canLogin"] > 0) {
					if (Valid::vArray($userVar[0])) {
						if (isset($_SESSION["User"])) {
							unset($_SESSION["User"]);
						}
						$_SESSION["User"] = $userVar[0];
					}
					$returnText = sTranslate::ACTION["Success"]["content"];
				}
			}
		}
		$returnContent =
			'
            <div class="text-center justification-centered">
                <h4>' .
			$returnText .
			'</h4>
                ' .
			sForm::Spinner(["x" => "Home", "reload" => true]) .
			'
            </div>';
		echo sFrame::Modal(["path" => $urlPaths["Root"], "content" => $returnContent]);
	} elseif (isset($_POST["x"]) && !strcmp($_POST["x"], "Login")) {
		$modalBody =
			'
            <form class="needs-validation" novalidate autocomplete="on">
                    <div class="form-group col-12 p-1">
                        <div class="input-group pb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="usrLogin-userName" ' .
			(isset($_POST["userName"]) && Valid::vString($_POST["userName"])
				? 'value="' . $_POST["userName"] . '"'
				: 'placeholder="Felhasználónév"') .
			' autocomplete="username" required>
                        </div>
                        <div class="input-group pb-1">
                            <input type="password" class="form-control" id="usrLogin-pWord" placeholder="Jelszó" autocomplete="current-password" required>
                        </div>
                        <button class="btn btn-primary col-12" id="usrLogin-button">Login</button>
                    </div>
                </form>';
		echo sFrame::Modal(["path" => $urlPaths["Root"], "content" => $modalBody]);
	} else {
		echo sRedirect::Home();
	}
} else {
	echo sRedirect::Home();
}
?>
