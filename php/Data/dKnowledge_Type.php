<?php

declare(strict_types=1);

namespace Data;

use Database\dbKnowledge_Type;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dKnowledge_Type implements iData
{
    private static $dbKnowledge_Type;

    public function __construct()
    {
        self::$dbKnowledge_Type = new dbKnowledge_Type();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbKnowledge_Type->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbKnowledge_Type->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbKnowledge_Type->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbKnowledge_Type->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbKnowledge_Type->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbKnowledge_Type->Check());
    }
}
