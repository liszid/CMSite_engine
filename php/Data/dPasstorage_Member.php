<?php

declare(strict_types=1);

namespace Data;

use Database\dbPasstorage_Member;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dPasstorage_Member implements iData
{
    private static $dbPasstorage_Member;

    public function __construct()
    {
        self::$dbPasstorage_Member = new dbPasstorage_Member();
    }

    public static function Insert(array $array = array()): bool
    {
        if (
            isset($array['passtorageId'])
            && isset($array['huntgroupId'])
        ) {
            return self::$dbPasstorage_Member->Insert($array);
        } else {
            return false;
        }
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbPasstorage_Member->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbPasstorage_Member->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbPasstorage_Member->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbPasstorage_Member->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbPasstorage_Member->Check());
    }
}
