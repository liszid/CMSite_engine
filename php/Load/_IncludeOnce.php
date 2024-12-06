<?php

/**
 * Functional class, with no constructor
 * 
 * @author Liszi Dániel
 */

declare(strict_types=1);

namespace Load;

class _IncludeOnce extends Loader implements iLoader
{
/**
 * Class interpretaion for Directory load with include_once
 * 
 * @author Liszi Dániel
 */
    public static function Directory(array $array): bool
    {
        return self::directoryLoad($array, 'include_once');
    }
/**
 * Class interpretaion for File load with include_once
 * 
 * @author Liszi Dániel
 */
    public static function File(array $array): bool
    {
        return self::fileLoad($array, 'include_once');
    }
}
