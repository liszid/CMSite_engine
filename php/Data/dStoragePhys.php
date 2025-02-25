<?php

declare(strict_types=1);

namespace Data;

use Database\dbStoragePhys;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dStoragePhys implements iData
{
    private static $dbStoragePhys;

    public function __construct()
    {
        self::$dbStoragePhys = new dbStoragePhys();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbStoragePhys->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbStoragePhys->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbStoragePhys->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbStoragePhys->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbStoragePhys->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbStoragePhys->Check());
    }
}
