<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\{Log, Check, Valid};

class qHuntgroup
{
	public static function Get(): array
	{
		return [
			"Insert" => self::Insert(),
			"Select" => self::Select(),
			"Update" => self::Update(),
			"Delete" => self::Delete(),
		];
	}

	private static function Insert()
	{
		return "
			INSERT INTO `Huntgroup`(
				huntgroupName
				,huntgroupDesc
				,isDelete
			) VALUES (
				:huntgroupName/**/
				,:huntgroupDesc/**/
				,:isDelete/**/
			);
		";
	}

	private static function Select()
	{
		return [
			"All" => "
				SELECT
					*
				FROM `Huntgroup`
				WHERE huntgroupName NOT LIKE '#%'
				ORDER BY huntgroupName ASC",
			"byHuntgroupId" => "
				SELECT
					*
				FROM `Huntgroup`
				WHERE huntgroupId=:huntgroupId/**/",
			"forMemberEdit" => "
				SELECT
					huntgroupId
					,huntgroupName
					,huntgroupDesc
				FROM `Huntgroup`
				ORDER BY huntgroupName ASC",
			"byHuntgroupName_Last" => "
				SELECT
					huntgroupId
				FROM `Huntgroup`
				WHERE huntgroupName=:huntgroupName/**/
				ORDER BY huntgroupId DESC LIMIT 1",
		];
	}

	private static function Update()
	{
		return "
			UPDATE
				`Huntgroup`
			SET
				huntgroupName=:huntgroupName/**/
				,huntgroupDesc=:huntgroupDesc/**/
			WHERE
				huntgroupId=:huntgroupId/**/";
	}

	private static function Delete()
	{
		return "DELETE FROM `Huntgroup` WHERE huntgroupId=:huntgroupId/**/";
	}
}
?>
