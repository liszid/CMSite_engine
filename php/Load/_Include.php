<?php

/**
 * Functional class, with no constructor
 * 
 * @author Liszi Dániel
 */

declare(strict_types=1);

namespace Load;

class _Include extends Loader implements iLoader
{
/**
 * Class interpretaion for Directory load with include
 * 
 * @author Liszi Dániel
 */
    public static function Directory(array $array): bool
    {
        return self::directoryLoad($array, 'include');
    }
/**
 * Class interpretaion for File load with include
 * 
 * @author Liszi Dániel
 */
    public static function File(array $array): bool
    {
        return self::fileLoad($array, 'include');
    }
}
