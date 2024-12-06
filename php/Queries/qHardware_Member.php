<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qHardware_Member
{
	public static function Get(): array
    {
		return array(
			'Insert' => self::Insert()
			,'Select' => self::Select()
			,'Update' => self::Update()
			,'Delete' => self::Delete()
		);
	}
	
	private static function Insert()
	{
		return "
			INSERT INTO `Hardware_Member`(
				hardwareId
				,huntgroupId
			) VALUES (
				:hardwareId/**/
				,:huntgroupId/**/
			);
		";
	}
	
	private static function Select()
	{
		return array(
			'All' => "
				SELECT
					*
				FROM `Hardware_Member`"
			,'byHardwareId' => "
				SELECT
					*
				FROM `Hardware_Member`
				WHERE hardwareId=:hardwareId/**/"
			,'byHuntgroupId' => "
				SELECT
					*
				FROM `Hardware_Member`
				WHERE huntgroupId=:huntgroupId/**/"
			,'byHardwareMemberId' => "
				SELECT
					*
				FROM `Hardware_Member`
				WHERE hardwareMemberId=:hardwareMemberId/**/"
		);
	}
	
	private static function Update()
	{
		return "";
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Hardware_Member` WHERE huntgroupId=:huntgroupId/**/ AND hardwareId=:hardwareId/**/";
	}
}