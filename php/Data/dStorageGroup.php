<?php

declare(strict_types=1);

namespace Data;

use Database\dbStorageGroup;

use Toolkit\{Log, Check, Valid};

class dStorageGroup implements iData
{
    private static $dbStorageGroup;

    public function __construct()
    {
        self::$dbStorageGroup = new dbStorageGroup();
    }

    public static function Insert(array $array = []): bool
    {
        return self::$dbStorageGroup->Insert($array);
    }

    public static function Select(array $array = [], string $type = ""): array
    {
        return self::$dbStorageGroup->Select($array, $type);
    }

    public static function Update(array $array = [], string $type = ""): bool
    {
        return self::$dbStorageGroup->Update($array, $type);
    }

    public static function Delete(array $array = [], string $type = ""): bool
    {
        return self::$dbStorageGroup->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbStorageGroup->Class_Id();
    }

    public static function Check(): bool
    {
        return self::$dbStorageGroup->Check();
    }
}
?>