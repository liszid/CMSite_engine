<?php
declare(strict_types = 1);
session_start();
session_regenerate_id();

require_once 'AutoLoader.php';

use Toolkit\ {
	Log
	,Check
	,Valid
};
use Data\dCombined;
use Database\Table;

/** @var string $formPage Its value indicates which file should be loaded */
$formPage = Check::isEither(array('post' => array('a', 'x'), 'get' => 'p', 'fallBack' => 'Home'));

/** Set user activity if the user is logged in */
if (isset($_SESSION['User'])) {
	$dCombined = new dCombined();
	$userVar = $dCombined->Select($_SESSION['User'], 'User_Full');
}

/** @var array $sessionUsr Globally useable, shorthand for $_SESSION['User'] */
$sessionUsr = (isset($_SESSION['User'])) ? $_SESSION['User'] : array();

/** @var array $sessionId Globally useable, shorthand for $_SESSION['User']['userId'] */
$sessionId = (!empty($sessionUsr)) ? $sessionUsr['userId'] : 0;

/** Checks if database tables are all set */
if (!isset($_SESSION['Database'])) {
	$Table = new Table();
	if ($Table::initTable() === true) {
		$_SESSION['Database'] = true;
	}
}

/** Loads the page using the form */
if (Valid::vString($formPage)) {
	if (file_exists($GLOBALS['Directory']['Page'] . $formPage . '.php')) {
		if (!preg_match('/[^A-Za-z0-9]/', $formPage)) {
			require_once $GLOBALS['Directory']['Page'] . $formPage . '.php';
		}
	}
}
?>