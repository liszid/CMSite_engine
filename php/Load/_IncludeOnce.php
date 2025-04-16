<?php

declare(strict_types=1);

namespace Load;

class _IncludeOnce extends Loader implements iLoader
{
    public static function Directory(array $array): bool
    {
        return self::directoryLoad($array, "include_once");
    }
    
    public static function File(array $array): bool
    {
        return self::fileLoad($array, "include_once");
    }
}
?>