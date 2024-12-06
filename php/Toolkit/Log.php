<?php

declare(strict_types=1);

namespace Toolkit;

class Log
{
/**
 * Writes error log in seperate file
 *
 * @param $string string
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    public static function Error(string $string): bool
    {
        return self::Write('Error: '.$string, 'errorLog');
    }
/**
 * Writes export log of variable into a seperate file
 *
 * @param object $variable
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    public static function Export($variable): bool
    {
        return self::Write(var_export($variable, true), 'exportLog');
    }

/**
 * Writes log into designated file
 *
 * @param $string string
 * @param $file string
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    public static function Write(string $string, string $file = "defaultLog"): bool
    {
        $file = fopen($GLOBALS['Directory']['Log'].$file,"a");

        echo fwrite($file, "[".date("h:i:s")."] - ".$string."\n");

        fclose($file);

        return true;
    }
}
