<?php

declare(strict_types=1);

namespace Data;

use Database\dbKnowledge_File;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dKnowledge_File implements iData
{
    private static $dbKnowledge_File;

    public function __construct()
    {
        self::$dbKnowledge_File = new dbKnowledge_File();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbKnowledge_File->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbKnowledge_File->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbKnowledge_File->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbKnowledge_File->Delete($array, $type);
    }

    public static function Check( ): bool
    {
        return (self::$dbKnowledge_File->Check());
    }

    public static function Class_Id(): int
    {
        return self::$dbKnowledge_File->Class_Id();
    }
}
