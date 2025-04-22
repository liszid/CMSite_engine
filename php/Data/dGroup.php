<?php

declare(strict_types=1);

namespace Data;

use Database\Routing;

use Toolkit\{Log, Check, Valid};

class dGroup implements iData
{
    private static $dbGroup;
    /**
     * [[Description]]
     * @private
     * @author Daniel Liszi
     */
    public function __construct()
    {
        self::$dbGroup = new Routing(1);
    }

    public static function Insert(array $array = []): bool
    {
        return self::$dbGroup->Insert($array);
    }

    public static function Select(array $array = [], string $type = ""): array
    {
        return self::$dbGroup->Select($array, $type);
    }

    public static function Update(array $array = [], string $type = ""): bool
    {
        return self::$dbGroup->Update($array, $type);
    }

    public static function Delete(array $array = [], string $type = ""): bool
    {
        $Group = self::Select($array, "byGroupId")[0];
        if (!empty($Group)) {
            if ($Group["isDelete"]) {
                $dGroup_Member = new dGroup_Member();
                $Members = $dGroup_Member->Select($array, "byGroupId");
                foreach ($Members as $i) {
                    $dGroup_Member->Update(["userId" => $i["userId"], "groupId" => 2]);
                }
                return self::$dbGroup->Delete($array, $type);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function Class_Id(): int
    {
        return self::$dbGroup->Class_Id();
    }

    public static function Check(): bool
    {
        return self::$dbGroup->Check();
    }
}
?>
