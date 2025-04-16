<?php

declare(strict_types=1);

namespace Data;

use Database\dbStorageId;

use Toolkit\{Log, Check, Valid};

class dStorageId implements iData
{
    private static $dbStorageId;

    public function __construct()
    {
        self::$dbStorageId = new dbStorageId();
    }

    public static function Insert(array $array = []): bool
    {
        return self::$dbStorageId->Insert($array);
    }

    public static function Select(array $array = [], string $type = ""): array
    {
        return self::$dbStorageId->Select($array, $type);
    }

    public static function Update(array $array = [], string $type = ""): bool
    {
        return self::$dbStorageId->Update($array, $type);
    }

    public static function Delete(array $array = [], string $type = ""): bool
    {
        return self::$dbStorageId->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbStorageId->Class_Id();
    }

    public static function Check(): bool
    {
        return self::$dbStorageId->Check();
    }
}
?>
