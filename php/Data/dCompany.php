<?php

declare(strict_types=1);

namespace Data;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Database\dbCompany;

use Samples\sActivity;

class dCompany implements iData
{
    private static $dbCompany;

    public function __construct()
    {
        self::$dbCompany = new dbCompany();
    }

    public static function Insert(array $array = array()): bool
    {
        $returnData = self::$dbCompany->Insert($array);

        $dCombined = new dCombined();
        sActivity::Set(($dCombined->Select($array,'User_Full'))[0]);

        return $returnData;
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbCompany->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbCompany->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbCompany->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbCompany->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbCompany->Check());
    }
}
