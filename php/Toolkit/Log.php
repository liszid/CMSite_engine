<?php

declare(strict_types=1);

namespace Toolkit;

class Log
{
    public static function Error(string $string): bool
    {
        return self::Write("Error: " . $string, "errorLog");
    }

    public static function Export($variable): bool
    {
        return self::Write(var_export($variable, true), "exportLog");
    }

    public static function Write(string $string, string $file = "defaultLog"): bool
    {
        $file = fopen($GLOBALS["Directory"]["Log"] . $file, "a");
        echo fwrite($file, "[" . date("h:i:s") . "] - " . $string . "\n");
        fclose($file);
        return true;
    }
}
?>