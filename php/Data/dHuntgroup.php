<?php

declare(strict_types=1);

namespace Data;

use Database\Routing;

use Toolkit\{Log, Check, Valid};

class dHuntgroup implements iData
{
    private static $dbHuntgroup;
    private static $dHuntgroup_Member;

    public function __construct()
    {
        self::$dbHuntgroup = new Routing(3);
        self::$dHuntgroup_Member = new dHuntgroup_Member(4);
    }

    public static function Insert(array $array = []): bool
    {
        return self::$dbHuntgroup->Insert($array);
    }

    public static function Select(array $array = [], string $type = ""): array
    {
        return self::$dbHuntgroup->Select($array, $type);
    }

    public static function Update(array $array = [], string $type = ""): bool
    {
        if (isset($array["userCheckbox"]) && !empty($array["userCheckbox"])) {
            $userIdArray = explode(",", $array["userCheckbox"]);
            $memberIdArray = self::$dHuntgroup_Member->Select($array, "byHuntgroupId");

            if (empty($memberIdArray)) {
                foreach ($userIdArray as $UId) {
                    if (!empty($UId)) {
                        self::$dHuntgroup_Member->Insert(["huntgroupId" => $array["huntgroupId"], "userId" => $UId]);
                    }
                }
            } elseif ($memberIdArray) {
                $newArray = [];
                $oldArray = [];

                foreach ($userIdArray as $i) {
                    if (!empty($i)) {
                        $newArray[] = $i;
                    }
                }

                foreach ($memberIdArray as $i) {
                    $oldArray[] = $i["userId"];
                }

                $oldDiff = ($var = array_diff($oldArray, $newArray)) !== [] ? $var : false;
                $newDiff = ($var = array_diff($newArray, $oldArray)) !== [] ? $var : false;

                if ($oldDiff) {
                    foreach ($oldDiff as $i) {
                        if (
                            !self::$dHuntgroup_Member->Delete(["huntgroupId" => $array["huntgroupId"], "userId" => $i])
                        ) {
                            return false;
                        }
                    }
                }
                if ($newDiff) {
                    foreach ($newDiff as $i) {
                        if (
                            !self::$dHuntgroup_Member->Insert(["huntgroupId" => $array["huntgroupId"], "userId" => $i])
                        ) {
                            return false;
                        }
                    }
                }
            } else {
                return false;
            }
        }

        return self::$dbHuntgroup->Update($array, $type) || true;
    }

    public static function Delete(array $array = [], string $type = ""): bool
    {
        $Huntgroup = self::Select($array, "byHuntgroupId")[0];
        if (!empty($Huntgroup)) {
            if ($Huntgroup["isDelete"]) {
                $dHuntgroup_Member = new dHuntgroup_Member();
                $Members = $dHuntgroup_Member->Select($array, "byHuntgroupId");
                foreach ($Members as $i) {
                    $dHuntgroup_Member->Update(
                        ["userId" => $i["userId"], "huntgroupId" => $array["huntgroupId"]],
                        "byUserId"
                    );
                }
                return self::$dbHuntgroup->Delete($array, $type);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function Class_Id(): int
    {
        return self::$dbHuntgroup->Class_Id();
    }

    public static function Check(): bool
    {
        return self::$dbHuntgroup->Check();
    }
}
?>
