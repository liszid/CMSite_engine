<?php

declare(strict_types=1);

namespace Data;

use Database\dbSymmetrix;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dSymmetrix implements iData
{
    private static $dbSymmetrix;

    public function __construct()
    {
        self::$dbSymmetrix = new dbSymmetrix();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbSymmetrix->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbSymmetrix->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbSymmetrix->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbSymmetrix->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbSymmetrix->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbSymmetrix->Check());
    }
}
