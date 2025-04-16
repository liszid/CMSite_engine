<?php

declare(strict_types=1);

namespace Data;

use Database\Routing;

use Toolkit\{Log, Check, Valid};

class dCombined implements iData
{
    private static $dbCombined;

    public function __construct()
    {
        self::$dbCombined = new Routing(99);
    }

    public static function Insert(array $array = []): bool
    {
        return self::$dbCombined->Insert($array);
    }

    public static function Select(array $array = [], string $type = ""): array
    {
        return self::$dbCombined->Select($array, $type);
    }

    public static function Update(array $array = [], string $type = ""): bool
    {
        return self::$dbCombined->Update($array, $type);
    }

    public static function Delete(array $array = [], string $type = ""): bool
    {
        return self::$dbCombined->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbCombined->Class_Id();
    }

    public static function Check(): bool
    {
        return self::$dbCombined->Check();
    }
}
?>
