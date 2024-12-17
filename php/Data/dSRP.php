<?php

declare(strict_types=1);

namespace Data;

use Database\dbSRP;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dSRP implements iData
{
    private static $dbSRP;

    public function __construct()
    {
        self::$dbSRP = new dbSRP();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbSRP->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbSRP->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbSRP->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbSRP->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbSRP->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbSRP->Check());
    }
}
