<?php

declare(strict_types=1);

namespace Data;

interface iData
{
/**
 * Morphic function for INSERT action
 * 
 * @param $array array
 * 
 * @return bool
 * 
 * @author Liszi Dániel
 */
    public static function Insert(array $array): bool;
/**
 * Morphic function for SELECT action
 * 
 * @param $array array
 * @param $type string
 * 
 * @return bool
 * 
 * @author Liszi Dániel
 */
    public static function Select(array $array, string $type): array;
/**
 * Morphic function for UPDATE action
 * 
 * @param $array array
 * @param $type string
 * 
 * @return array
 * 
 * @author Liszi Dániel
 */
    public static function Update(array $array, string $type): bool;
/**
 * Morphic function for DELETE action
 * 
 * @param $array array
 * @param $type string
 * 
 * @return bool
 * 
 * @author Liszi Dániel
 */
    public static function Delete(array $array, string $type): bool;
/**
 * Function to get if the class is Active
 * 
 * @return bool
 * 
 * @author Liszi Dániel
 */
    public static function Check( ): bool;
}