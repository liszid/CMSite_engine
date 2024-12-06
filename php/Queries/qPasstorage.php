<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qPasstorage
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
			INSERT INTO `Passtorage`(
				passtorageName
				,passtorageDesc
				,companySiteId
				,userId
			) VALUES (
				:passtorageName/**/
				,:passtorageDesc/**/
				,:companySiteId/**/
				,:userId/**/
			);
		";
	}
	
	private static function Select()
	{
		return array(
			'All' => "
				SELECT
					`Passtorage`.*
					,`Company_Site`.companySiteName
				FROM `Company_Site`
				INNER JOIN `Passtorage` USING (companySiteId)"
			,'byPasstorageId' => "
				SELECT
					`Passtorage`.*
					,`User`.userName
				FROM `Passtorage`
				LEFT JOIN `User` USING (userId)
				WHERE passtorageId=:passtorageId/**/"
			,'byUserId_Last' => "
				SELECT
					passtorageId
				FROM `Passtorage`
				WHERE userId=:userId/**/
				ORDER BY passtorageId DESC LIMIT 1"
			,'byUserId' => "
				SELECT
					userId
				FROM `Passtorage`
				WHERE userId=:userId/**/"
		);
	}
	
	private static function Update()
	{
		return "
			UPDATE
				`Passtorage`
			SET
				passtorageName=:passtorageName/**/
				,passtorageDesc=:passtorageDesc/**/
				,companySiteId=:companySiteId/**/
			WHERE
				passtorageId=:passtorageId/**/
		";
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Passtorage` WHERE passtorageId=:passtorageId/**/";
	}
}