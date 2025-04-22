<?php

declare(strict_types=1);

namespace Data;

use Database\Routing;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dStorageTotal implements iData
{
    private static $dbStorageTotal;

    public function __construct()
    {
        self::$dbStorageTotal = new Routing(12);
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbStorageTotal->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbStorageTotal->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbStorageTotal->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbStorageTotal->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbStorageTotal->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbStorageTotal->Check());
    }
}
?>