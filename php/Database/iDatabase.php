<?php

declare(strict_types=1);

namespace Database;

interface iDatabase
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
     * @return bool
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
     * Returns the ID of the class
     *
     * @return int
     *
     * @author Liszi Dániel
     */
    public static function Class_Id(): int;
    /**
     * Checks if class table exists
     *
     * @return bool
     *
     * @author Liszi Dániel
     */
    public static function Check(): bool;
}
?>
