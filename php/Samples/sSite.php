<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{Log, Check, Valid};

use Load\Loader as Load;

class sSite
{
	private static $sessionUsr;
	private static $sessionId;
	private static $sessionAct;

	public function __construct()
	{
		self::setSessionVariables();
		$wClass = $GLOBALS["Site"]["Style"]["Site"]["templateClass"];
		$promptString = new $wClass([
			"navbarRight" => self::NavbarRightArray(),
			"navbarLeft" => self::NavbarLeftArray(),
			"header" => self::Head(),
			"footer" => self::Footer(),
		]);
	}

	private static function setSessionVariables(): bool
	{
		self::$sessionUsr = isset($_SESSION["User"]) ? $_SESSION["User"] : [];
		self::$sessionId = !empty(self::$sessionUsr) ? self::$sessionUsr["userId"] : 0;
		return true;
	}

	private static function Head(): string
	{
		return '
            <head>
		<meta http-equiv="Content-Type" content="text/html; charset=' .
			$GLOBALS["Site"]["Content"]["Charset"] .
			'">
		<meta charset="' .
			$GLOBALS["Site"]["Content"]["Charset"] .
			'">
		<meta http-equiv="x-dns-prefetch-control" content="off">
		<title>' .
			$GLOBALS["Site"]["Content"]["Title"] .
			'</title>
		<meta name="viewport" content="height=device-height, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" id="viewport">
               <meta name="description" content="' .
			$GLOBALS["Site"]["Content"]["Description"] .
			'">
               <meta name="theme-color" content="' .
			$GLOBALS["Site"]["Content"]["Theme"] .
			'">
               <meta name="robots" content="index,follow">
               <meta name="googlebot" content="index,follow">
               <meta name="google" content="nositelinkssearchbox">
               <meta name="google" content="notranslate">
               <meta name="subject" content="' .
			$GLOBALS["Site"]["Content"]["Description"] .
			'">
               <meta name="rating" content="General">
               <meta name="referrer" content="no-referrer">
               <meta name="format-detection" content="telephone=no">
               <meta name="ICBM" content="' .
			$GLOBALS["Site"]["Content"]["ICBM"] .
			'">
               <meta name="geo.position" content="' .
			$GLOBALS["Site"]["Content"]["Position"] .
			'">
               <meta name="geo.region" content="' .
			$GLOBALS["Site"]["Content"]["Country"] .
			'">
               <meta name="geo.placename" content="' .
			$GLOBALS["Site"]["Content"]["City"] .
			'">
					' .
			Load::Favicon($GLOBALS["Static"]["FAVICON"]["path"]) .
			'
               ' .
			Load::CSS($GLOBALS["Static"]["CSS"]["path"]) .
			'
            </head>';
	}

	private static function Footer(): string
	{
		return '
			<div class="footer-copyright w-100 text-center py-1 bg-' .
			$GLOBALS["Site"]["Style"]["BGColor"]["Footer"] .
			" text-" .
			$GLOBALS["Site"]["Style"]["Text"]["Footer"] .
			'">
				<span>' .
			$GLOBALS["Site"]["Content"]["Copyright"] .
			'</span>
			</div>';
	}

	private static function NavbarRightArray(): array
	{
		if (!empty(self::$sessionUsr)) {
			$navName = "Logout";
			return [
				"liClass" => "",
				"aClass" => "",
				"faClass" => sTranslate::Prompt($navName, "fa"),
				"dataToggle" => true,
				"dataLink" => $navName,
				"Desc" => sTranslate::Prompt($navName),
				"hidden" => 0,
			];
		} else {
			$navName = "Login";
			return [
				"liClass" => "",
				"aClass" => "",
				"faClass" => sTranslate::Prompt($navName, "fa"),
				"dataToggle" => true,
				"dataLink" => $navName,
				"Desc" => sTranslate::Prompt($navName),
				"hidden" => 0,
			];
		}
	}

	private static function NavbarLeftArray(): array
	{
		$navName = "";
		$navArray = [];

		if (!empty(self::$sessionUsr)) {
			$navName = "Home";
			$navArray[] = [
				"liClass" => "",
				"aClass" => "",
				"faClass" => sTranslate::Prompt($navName, "fa"),
				"dataToggle" => false,
				"dataLink" => $navName,
				"Desc" => sTranslate::Prompt($navName),
				"hidden" => 1,
			];

			if ((int) self::$sessionUsr["mngGroups"] === 1 && (int) self::$sessionUsr["mngUsers"] === 1) {
				$navName = "Administrative";
				$navArray[] = [
					"liClass" => " dropdown",
					"aClass" => " dropdown-toggle",
					"faClass" => sTranslate::Prompt($navName, "fa"),
					"dataToggle" => "dropdown",
					"dataLink" => $navName,
					"dataItems" => ["Users", "Groups", "Huntgroups"],
					"Desc" => sTranslate::Prompt($navName),
					"hidden" => 1,
				];
			}

			$navName = "Plans/Calendar";
			$navArray[] = [
				"liClass" => "",
				"aClass" => "",
				"faClass" => sTranslate::Prompt($navName, "fa"),
				"dataToggle" => false,
				"dataLink" => $navName,
				"Desc" => sTranslate::Prompt($navName),
				"hidden" => 1,
			];
			
			$navName = "Plans/Kanban";
			$navArray[] = [
				"liClass" => "",
				"aClass" => "",
				"faClass" => sTranslate::Prompt($navName, "fa"),
				"dataToggle" => false,
				"dataLink" => $navName,
				"Desc" => sTranslate::Prompt($navName),
				"hidden" => 1,
			];
			
			$navName = "Performance/Laptop";
			$navArray[] = [
				"liClass" => "",
				"aClass" => "",
				"faClass" => sTranslate::Prompt($navName, "fa"),
				"dataToggle" => false,
				"dataLink" => $navName,
				"Desc" => sTranslate::Prompt($navName),
				"hidden" => 1,
			];

			$navName = "Profile";
			$navArray[] = [
				"liClass" => "",
				"aClass" => "",
				"faClass" => sTranslate::Prompt($navName, "fa"),
				"dataToggle" => true,
				"dataLink" => $navName,
				"Desc" => sTranslate::Prompt($navName),
				"hidden" => 1,
			];
		}
		return $navArray;
	}
}
?>
