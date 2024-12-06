<?php

declare(strict_types=1);

namespace Data;

use Database\dbPasstorage_File;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dPasstorage_File implements iData
{
    private static $dbPasstorage_File;

    public function __construct()
    {
        self::$dbPasstorage_File = new dbPasstorage_File();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbPasstorage_File->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbPasstorage_File->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbPasstorage_File->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbPasstorage_File->Delete($array, $type);
    }

    public static function Check( ): bool
    {
        return (self::$dbPasstorage_File->Check());
    }

    public static function Class_Id(): int
    {
        return self::$dbPasstorage_File->Class_Id();
    }
}
