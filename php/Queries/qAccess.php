<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qAccess
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
			INSERT INTO `Access`(
				passtorageId
				,accessUsername
				,accessPassword
				,accessLabel
				,accessLink
				,userId
			) VALUES (
				:passtorageId/**/
				,:accessUsername/**/ 
				,:accessPassword/**/
				,:accessLabel/**/
				,:accessLink/**/
				,:userId/**/
			);
		";
	}
	
	private static function Select()
	{
		return array(
			'All' => "
				SELECT
					*
				FROM `Access`"
			,'byAccessId' => "
				SELECT
					`Access`.*
					,`User`.userName
				FROM `Access`
				INNER JOIN `User` USING (userId)
				WHERE accessId=:accessId/**/"
			,'byUserId' => "
				SELECT
					userId
				FROM `Access`
				WHERE userId=:userId/**/"
		);
	}
	
	private static function Update()
	{
		return "
			UPDATE
				`Access`
			SET
				accessUsername=:accessUsername/**/
				,accessPassword=:accessPassword/**/
				,accessLabel=:accessLabel/**/
				,accessLink=:accessLink/**/
				,passtorageId=:passtorageId/**/
			WHERE
				accessId=:accessId/**/
		";
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Access` WHERE accessId=:accessId/**/";
	}
}