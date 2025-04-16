<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\{Log, Check, Valid};

class qLog
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
			INSERT INTO `Log`(
				logType
				,logAction
				,logCategory
				,logText
				,userId
				,logBool
			) VALUES (
				:logType/**/
				,:logAction/**/
				,:logCategory/**/
				,:logText/**/
				,:userId/**/
				,:logBool/**/
			);
		";
	}

	private static function Select()
	{
		return [
			"All" => "
				SELECT
					`Log`.*
					,`User`.userName
				FROM `Log`
				INNER JOIN `User` USING (userId)
				ORDER BY `Log`.logId DESC
				LIMIT 100",
		];
	}

	private static function Update()
	{
		return "";
	}

	private static function Delete()
	{
		return "";
	}
}
?>
