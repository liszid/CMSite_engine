<?php

declare(strict_types=1);

namespace Data;

use Database\dbHuntgroup_Member;

use Toolkit\{Log, Check, Valid};

class dHuntgroup_Member implements iData
{
    private static $dbHuntgroup_Member;

    public function __construct()
    {
        self::$dbHuntgroup_Member = new dbHuntgroup_Member();
    }

    public static function Insert(array $array = []): bool
    {
        if (isset($array["userId"]) && isset($array["huntgroupId"])) {
            return self::$dbHuntgroup_Member->Insert($array);
        } else {
            return false;
        }
    }

    public static function Select(array $array = [], string $type = ""): array
    {
        return self::$dbHuntgroup_Member->Select($array, $type);
    }

    public static function Update(array $array = [], string $type = ""): bool
    {
        if (isset($array["huntgroupId"]) && (isset($array["userId"]) || isset($array["huntgroupMemberId"]))) {
            return self::$dbHuntgroup_Member->Update($array, $type);
        } else {
            return false;
        }
    }

    public static function Delete(array $array = [], string $type = ""): bool
    {
        return self::$dbHuntgroup_Member->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbHuntgroup_Member->Class_Id();
    }

    public static function Check(): bool
    {
        return self::$dbHuntgroup_Member->Check();
    }
}
?>
