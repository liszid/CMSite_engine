<?php

declare(strict_types=1);

namespace Data;

use Database\dbLog;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dLog implements iData
{
    private static $dbLog;

    public function __construct()
    {
        self::$dbLog = new dbLog();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbLog->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbLog->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbLog->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbLog->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbLog->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbLog->Check());
    }
}
