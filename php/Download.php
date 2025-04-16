<?php
declare(strict_types=1);
header("Content-Type: " . $_GET["ft"]);
header('Content-Disposition: attachment; filename="' . $_GET["fn"] . '"');
readfile($_SERVER["DOCUMENT_ROOT"] . $_GET["fs"]);
exit();
?>
