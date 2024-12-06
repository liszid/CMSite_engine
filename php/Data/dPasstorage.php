<?php

declare(strict_types=1);

namespace Data;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Database\dbPasstorage;

use Samples\sActivity;

class dPasstorage implements iData
{
	private static $dbPasstorage;
	private static $dPasstorage_File;
	private static $dPasstorage_Member;
	const DATA = array(
		'passtorageName' => ''
		,'passtorageDesc' => ''
	);

    public function __construct()
    {
        self::$dbPasstorage = new dbPasstorage();
        self::$dPasstorage_File = new dPasstorage_File();
        self::$dPasstorage_Member = new dPasstorage_Member();
    }

	public static function Insert(array $array = array()): bool
	{
		$updateArray = self::DATA;

		$array = array_merge($updateArray, $array);
		$returnData = self::$dbPasstorage->Insert($array);

		$dCombined = new dCombined();
		sActivity::Set(($dCombined->Select($array,'User_Full'))[0]);

		return $returnData;
	}

	public static function Select(array $array = array(), string $type = ''): array
	{
		return self::$dbPasstorage->Select($array, $type);
	}

	public static function Update(array $array = array(), string $type = ''): bool
	{
      $bool = true;
		$updateArray = self::DATA;

		$array = array_merge($updateArray, $array);

		if(isset($array['huntgroupCheckbox']) && ! empty($array['huntgroupCheckbox'])) {
			$groupIdArray = explode(',', $array['huntgroupCheckbox']);
			$memberIdArray = self::$dPasstorage_Member->Select($array, 'byPasstorageId');

            if (empty($memberIdArray)) {
                foreach ($groupIdArray as $GId) {
                    if (! empty($GId)) {
                        self::$dPasstorage_Member->Insert( array( "passtorageId" => $array['passtorageId'], "huntgroupId" => $GId));
                    }
                }
            } elseif ($memberIdArray) {
                $newArray = array();
                $oldArray = array();

                foreach ($groupIdArray as $i) {
                    if (! empty($i)) {
                        $newArray[] = $i;
                    }
                }

                foreach ($memberIdArray as $i) {
                    $oldArray[] = $i['huntgroupId'];
                }

                $oldDiff = (($var =array_diff($oldArray, $newArray)) !== array())? $var : false;
                $newDiff = (($var =array_diff($newArray, $oldArray)) !== array())? $var : false;

                if ($oldDiff) {
                    foreach ($oldDiff as $i) {
                        if (! self::$dPasstorage_Member->Delete(array('passtorageId' => $array['passtorageId'], 'huntgroupId' => $i))) {
                            return false;
                        }
                    }
                } else {
                    $bool = false;
                }
                if ($newDiff) {
                    $bool = true;

                    foreach ($newDiff as $i) {
                        if (! self::$dPasstorage_Member->Insert(array('passtorageId' => $array['passtorageId'], 'huntgroupId' => $i))) {
                            return false;
                        }
                    }
                } else {
                    $bool = false;
                }
            } else {
                $bool = false;
            }
        }

        return (self::$dbPasstorage->Update($array, $type) ||  $bool);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        foreach ((self::$dPasstorage_File->Select($array,'byPasstorageId')) as $item) {
            if (file_exists('/app'.$item['passtorageFilePath'])) {
                unlink('/app'.$item['passtorageFilePath']);
            }
        }

        return self::$dbPasstorage->Delete($array, $type);
    }

    public static function Check( ): bool
    {
        return (self::$dbPasstorage->Check());
    }

    public static function Class_Id(): int
    {
        return self::$dbPasstorage->Class_Id();
    }

}
