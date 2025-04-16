<?php

declare(strict_types=1);

namespace Toolkit;

class Upload
{
    private static $wClass;
    public static function Upload(): bool
    {
        if (isset($_POST["classId"])) {
            $File = $_FILES["fileToUpload"];
            $fTarget = $GLOBALS["Directory"]["Upload"] . md5(date("YmdHis") . basename($File["name"]));
            $fSource = $File["tmp_name"];
            $className = $GLOBALS["Upload"][$_POST["classId"]]["className"];
            if (file_exists($fTarget) || $_FILES["fileToUpload"]["size"] > 50000000) {
                return false;
            } else {
                self::$wClass = new $className();

                $paramArray = [];

                foreach ($GLOBALS["Upload"][$_POST["classId"]] as $key => $item) {
                    if (isset($_POST[$key])) {
                        $paramArray[$item] = $_POST[$key];
                    } elseif (isset($File[$key])) {
                        $paramArray[$item] = $File[$key];
                    } elseif (!strcmp($key, "generated_file_path")) {
                        $paramArray[$item] = "/" . $fTarget;
                    }
                }

                if (move_uploaded_file($fSource, $fTarget)) {
                    return self::$wClass->Insert($paramArray);
                } else {
                    return false;
                }
            }
        }
    }
}
?>