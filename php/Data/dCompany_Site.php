<?php

declare(strict_types=1);

namespace Data;

use Toolkit\{
    Log
    ,Check
    ,Valid
};
use Database\dbCompany_Site;

use Samples\sActivity;

class dCompany_Site implements iData
{
    private static $dbCompany_Site;

    public function __construct()
    {
        self::$dbCompany_Site = new dbCompany_Site();
    }

    public static function Insert(array $array = array()): bool
    {
        $returnData = self::$dbCompany_Site->Insert($array);

        $dCombined = new dCombined();
        sActivity::Set(($dCombined->Select($array,'User_Full'))[0]);

        return $returnData;
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbCompany_Site->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        return self::$dbCompany_Site->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbCompany_Site->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbCompany_Site->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbCompany_Site->Check());
    }
}
