<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qHuntgroup_Member
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
			INSERT INTO `Huntgroup_Member`(
				userId
				,huntgroupId
			) VALUES (
				:userId/**/
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
				FROM `Huntgroup_Member`"
			,'byUserId' => "
				SELECT
					*
				FROM `Huntgroup_Member`
				WHERE userId=:userId/**/"
			,'byHuntgroupId' => "
				SELECT
					*
				FROM `Huntgroup_Member`
				WHERE huntgroupId=:huntgroupId/**/"
			,'byHuntgroupMemberId' => "
				SELECT
					*
				FROM `Huntgroup_Member`
				WHERE huntgroupMemberId=:huntgroupMemberId/**/"
		);
	}
	
	private static function Update()
	{
		return array(
			"byUserId" => "
				UPDATE
					`Huntgroup_Member`
				SET
					huntgroupId=:huntgroupId/**/
				WHERE
					userId=:userId/**/",

			"byHuntgroupMemberId" => "
				UPDATE
					`Huntgroup_Member`
				SET
					huntgroupId=:huntgroupId/**/
				WHERE
					huntgroupMemberId=:huntgroupMemberId/**/"
		);
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Huntgroup_Member` WHERE huntgroupId=:huntgroupId/**/ AND userId=:userId/**/";
	}
}