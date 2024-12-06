<?php

declare(strict_types=1);

namespace Data;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Database\dbHardware;

use Samples\sActivity;

class dHardware implements iData
{
	private static $dbHardware;
	private static $dHardware_File;
	private static $dHardware_Member;
	const DATA = array(
		'hardwareName' => ''
		,'hardwareDesc' => ''
		,'hardwarePrice' => ''
		,'hardwareDateIn' => ''
		,'hardwareGuaranteeDate' => ''
		,'hardwareDate' => ''
	);

    public function __construct()
    {
        self::$dbHardware = new dbHardware();
        self::$dHardware_File = new dHardware_File();
        self::$dHardware_Member = new dHardware_Member();
    }

	public static function Insert(array $array = array()): bool
	{
		$updateArray = self::DATA;
		$array = array_merge($updateArray, $array);
		$returnData = self::$dbHardware->Insert($array);

		$dCombined = new dCombined();
		sActivity::Set(($dCombined->Select($array,'User_Full'))[0]);

		return $returnData;
	}

	public static function Select(array $array = array(), string $type = ''): array
	{
		return self::$dbHardware->Select($array, $type);
	}

	public static function Update(array $array = array(), string $type = ''): bool
	{
      $bool = true;
		$updateArray = self::DATA;

		$array = array_merge($updateArray, $array);

		if(isset($array['huntgroupCheckbox']) && ! empty($array['huntgroupCheckbox'])) {
			$groupIdArray = explode(',', $array['huntgroupCheckbox']);
			$memberIdArray = self::$dHardware_Member->Select($array, 'byHardwareId');

            if (empty($memberIdArray)) {
                foreach ($groupIdArray as $GId) {
                    if (! empty($GId)) {
                        self::$dHardware_Member->Insert( array( "hardwareId" => $array['hardwareId'], "huntgroupId" => $GId));
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
                        if (! self::$dHardware_Member->Delete(array('hardwareId' => $array['hardwareId'], 'huntgroupId' => $i))) {
                            return false;
                        }
                    }
                } else {
                    $bool = false;
                }
                if ($newDiff) {
                    $bool = true;

                    foreach ($newDiff as $i) {
                        if (! self::$dHardware_Member->Insert(array('hardwareId' => $array['hardwareId'], 'huntgroupId' => $i))) {
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

        return (self::$dbHardware->Update($array, $type) ||  $bool);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        foreach ((self::$dHardware_File->Select($array,'byHardwareId')) as $item) {
            if (file_exists('/app'.$item['hardwareFilePath'])) {
                unlink('/app'.$item['hardwareFilePath']);
            }
        }

        return self::$dbHardware->Delete($array, $type);
    }

    public static function Check( ): bool
    {
        return (self::$dbHardware->Check());
    }

    public static function Class_Id(): int
    {
        return self::$dbHardware->Class_Id();
    }

}
