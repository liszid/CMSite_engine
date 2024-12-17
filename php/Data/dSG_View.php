<?php

declare(strict_types=1);

namespace Data;

use Database\dbSG_View;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dSG_View implements iData
{
    private static $dbSG_View;

    public function __construct()
    {
        self::$dbSG_View = new dbSG_View();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbSG_View->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbSG_View->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbSG_View->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbSG_View->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbSG_View->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbSG_View->Check());
    }
}
