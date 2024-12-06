<?php

/**
 * Default useage is to call the Directory or File mode of Loading
 * By default Css/Js/Favicon files are returned as <HTML tags> in string format,
 * while PHPs return Boolean on load.
 *
 * @copyright Since 2020
 * @author Liszi Dániel
 */

declare(strict_types=1);

namespace Load;

/**
 * Interface of Loading statements
 *
 * @author Liszi Dániel
 */
interface iLoader
{
/**
 * Loads directory items with require
 * 
 * @param $array array
 * 
 * @return bool
 *
 * @author Liszi Dániel
 */
    public static function Directory(array $array): bool;

/**
 * Loads files from different directories with require
 * 
 * @param $array array
 * 
 * @return bool
 *
 * @author Liszi Dániel
 */
    public static function File(array $array): bool;
}
