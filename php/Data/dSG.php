<?php

declare(strict_types=1);

namespace Data;

use Database\dbSG_Info;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dSG_Info implements iData
{
    private static $dbSG_Info;

    public function __construct()
    {
        self::$dbSG_Info = new dbSG_Info();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbSG_Info->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbSG_Info->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbSG_Info->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbSG_Info->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbSG_Info->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbSG_Info->Check());
    }
}
