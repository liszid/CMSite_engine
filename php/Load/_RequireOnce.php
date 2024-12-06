<?php

/**
 * Functional class, with no constructor
 * 
 * @author Liszi Dániel
 */

declare(strict_types=1);

namespace Load;

class _RequireOnce extends Loader implements iLoader
{
/**
 * Class interpretaion for Directory load with require_once
 * 
 * @author Liszi Dániel
 */
    public static function Directory(array $array): bool
    {
        return self::directoryLoad($array, 'require_once');
    }
/**
 * Class interpretaion for File load with require_once
 * 
 * @author Liszi Dániel
 */
    public static function File(array $array): bool
    {
        return self::fileLoad($array, 'require_once');
    }
}
