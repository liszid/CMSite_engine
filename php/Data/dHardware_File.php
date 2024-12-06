<?php

declare(strict_types=1);

namespace Data;

use Database\dbHardware_File;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dHardware_File implements iData
{
    private static $dbHardware_File;

    public function __construct()
    {
        self::$dbHardware_File = new dbHardware_File();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbHardware_File->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbHardware_File->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbHardware_File->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbHardware_File->Delete($array, $type);
    }

    public static function Check( ): bool
    {
        return (self::$dbHardware_File->Check());
    }

    public static function Class_Id(): int
    {
        return self::$dbHardware_File->Class_Id();
    }
}
