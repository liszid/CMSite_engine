<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qPasstorage_Member
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
			INSERT INTO `Passtorage_Member`(
				passtorageId
				,huntgroupId
			) VALUES (
				:passtorageId/**/
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
				FROM `Passtorage_Member`"
			,'byPasstorageId' => "
				SELECT
					*
				FROM `Passtorage_Member`
				WHERE passtorageId=:passtorageId/**/"
			,'byHuntgroupId' => "
				SELECT
					*
				FROM `Passtorage_Member`
				WHERE huntgroupId=:huntgroupId/**/"
			,'byPasstorageMemberId' => "
				SELECT
					*
				FROM `Passtorage_Member`
				WHERE passtorageMemberId=:passtorageMemberId/**/"
		);
	}
	
	private static function Update()
	{
		return "";
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Passtorage_Member` WHERE huntgroupId=:huntgroupId/**/ AND passtorageId=:passtorageId/**/";
	}
}