<?php

declare(strict_types=1);

namespace Data;

use Database\Routing;

use Toolkit\{Log, Check, Valid};

class dKanbanType implements iData
{
    private static $dbKanbanType;

    public function __construct()
    {
        self::$dbKanbanType = new Routing(31);
    }

    public static function Insert(array $array = []): bool
    {
        return self::$dbKanbanType->Insert($array);
    }

    public static function Select(array $array = [], string $type = ""): array
    {
        return self::$dbKanbanType->Select($array, $type);
    }

    public static function Update(array $array = [], string $type = ""): bool
    {
        return self::$dbKanbanType->Update($array, $type);
    }

    public static function Delete(array $array = [], string $type = ""): bool
    {
        return self::$dbKanbanType->Delete($array, $type);
    }

    public static function Check(): bool
    {
        return self::$dbKanbanType->Check();
    }

    public static function Class_Id(): int
    {
        return self::$dbKanbanType->Class_Id();
    }
}
?>