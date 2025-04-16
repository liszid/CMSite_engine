<?php

declare(strict_types=1);

namespace Load;

class _Include extends Loader implements iLoader
{
    public static function Directory(array $array): bool
    {
        return self::directoryLoad($array, "include");
    }
    
    public static function File(array $array): bool
    {
        return self::fileLoad($array, "include");
    }
}
?>