<?php

declare(strict_types=1);

namespace Data;

use Database\dbSG_Total;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dSG_Total implements iData
{
    private static $dbSG_Total;

    public function __construct()
    {
        self::$dbSG_Total = new dbSG_Total();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbSG_Total->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbSG_Total->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbSG_Total->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbSG_Total->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbSG_Total->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbSG_Total->Check());
    }
}
