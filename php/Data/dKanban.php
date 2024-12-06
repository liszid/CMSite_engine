<?php

declare(strict_types=1);

namespace Data;

use Database\dbKanban;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dKanban implements iData
{
    private static $dbKanban;

    public function __construct()
    {
        self::$dbKanban = new dbKanban();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbKanban->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbKanban->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbKanban->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbKanban->Delete($array, $type);
    }

    public static function Check( ): bool
    {
        return (self::$dbKanban->Check());
    }

    public static function Class_Id(): int
    {
        return self::$dbKanban->Class_Id();
    }
}
