<?php

declare(strict_types=1);

namespace Data;

use Database\dbCompany_Site_Type;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dCompany_Site_Type implements iData
{
    private static $dbCompany_Site_Type;

    public function __construct()
    {
        self::$dbCompany_Site_Type = new dbCompany_Site_Type();
    }

    public static function Insert(array $array = array()): bool
    {
        return self::$dbCompany_Site_Type->Insert($array);
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbCompany_Site_Type->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbCompany_Site_Type->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbCompany_Site_Type->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbCompany_Site_Type->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbCompany_Site_Type->Check());
    }
}
