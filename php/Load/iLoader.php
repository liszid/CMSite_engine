<?php

declare(strict_types=1);

namespace Load;

interface iLoader
{
    public static function Directory(array $array): bool;
    public static function File(array $array): bool;
}
?>
