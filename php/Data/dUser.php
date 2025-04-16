<?php

declare(strict_types=1);

namespace Data;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Database\Routing;

class dUser implements iData
{
    private static $dbUser;

    public function __construct()
    {
        self::$dbUser = new Routing(0);
    }

    public static function Insert(array $array = array()): bool
    {
        if (isset($array['userName']) && isset($array['userContEmail'])) {
            if (Valid::vInput($array['userContEmail'], 4) && Valid::vInput($array['userName'], 0)) {
                if(empty(self::Select($array, 'byUserName')) && empty(self::Select($array, 'byContEmail'))) {
                    $array['pWord'] = md5($array['userName']);
                    $bool_1 = self::$dbUser->Insert($array);
                    if ($bool_1) {
                        $dGroup_Member = new dGroup_Member();
                        $dHuntgroup = new dHuntgroup();
                        $dHuntgroup_Member = new dHuntgroup_Member();

                        $addHuntgroup = $dHuntgroup::Insert(array('huntgroupName' => '#_'.$array['userName'], 'huntgroupDesc' => 'Felhasználóra vonatkozó egyedi csoport', 'isDelete' => 0));

                        $selectUserId = (self::Select($array, 'byUserName'))[0]['userId'];
                        $selectHuntgroupId = $dHuntgroup::Select(array('huntgroupName' => '#_'.$array['userName']), 'byHuntgroupName_Last')[0]['huntgroupId'];

                        $addGroup_Member = $dGroup_Member::Insert(array('userId' => (int)$selectUserId, 'groupId' => (int)$GLOBALS['Data']['groupDefault']));
                        $addHuntgroup_Member_to_Self = $dHuntgroup_Member::Insert(array('userId' => (int)$selectUserId, 'huntgroupId' => $selectHuntgroupId));
                        $addHuntgroup_Member_to_Default = $dHuntgroup_Member::Insert(array('userId' => (int)$selectUserId, 'huntgroupId' => (int)$GLOBALS['Data']['huntgroupDefault']));

                        return ($addGroup_Member && $addHuntgroup_Member_to_Default && $addHuntgroup_Member_to_Self);
                    } else {
                        return false;
                    }
                }
            }
        }
        return false;
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbUser->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        switch ($type) {
            case 'Delete':
                $dGroup_Member = new dGroup_Member();
                return $dGroup_Member->Update($array, 'byUserId');
            case 'Edit':
                return self::$dbUser->Update($array, $type);
            case 'Password':
                $pWord = self::Select($array, 'Password')[0]['pWord'];
                if (
                    ! strcmp(md5($array['userPassword_Old']), $pWord)
                    && ! strcmp(md5($array['userPassword_New']), md5($array['userPassword_Repeat']))
                ) {
                    return self::$dbUser->Update(array('userId' => $array['userId'], 'pWord' => md5($array['userPassword_New'])), $type);
                } else {
                    return false;
                }
            case 'Reset':
                return self::$dbUser->Update(array('userId' => $array['userId'], 'pWord' => $array['pWord']), 'Password');
            default:
                return false;
        }
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        $User = self::Select($array, 'byUserId')[0];
        if(! empty($User)) {
            if ($User['isDelete']) {
                return self::$dbUser->Delete($array, $type);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function Class_Id(): int
    {
        return self::$dbUser->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbUser->Check());
    }
}

?>