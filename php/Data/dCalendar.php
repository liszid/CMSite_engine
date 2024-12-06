<?php

declare(strict_types=1);

namespace Data;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Database\dbCalendar;

use Samples\sActivity;

class dCalendar implements iData
{
    private static $dbCalendar;

    public function __construct()
    {
        self::$dbCalendar = new dbCalendar();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbCalendar->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbCalendar->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbCalendar->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbCalendar->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbCalendar->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbCalendar->Check());
    }
}
