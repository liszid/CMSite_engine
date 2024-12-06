<?php

declare(strict_types=1);

namespace Data;

use Database\dbCombined;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dCombined implements iData
{
    private static $dbCombined;

    public function __construct()
    {
        self::$dbCombined = new dbCombined();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbCombined->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbCombined->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbCombined->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbCombined->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbCombined->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbCombined->Check());
    }
}
