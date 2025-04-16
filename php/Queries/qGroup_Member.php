<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\{Log, Check, Valid};

class qGroup_Member
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
			INSERT INTO `Group_Member`(
				userId
				,groupId
			) VALUES (
				:userId/**/
				,:groupId/**/ 
			);
		";
	}

	private static function Select()
	{
		return [
			"All" => "
				SELECT
					*
				FROM `Group_Member`",
			"byUserId" => "
				SELECT
					*
				FROM `Group_Member`
				WHERE userId=:userId/**/",
			"byGroupId" => "
				SELECT
					*
				FROM `Group_Member`
				WHERE groupId=:groupId/**/",
			"byGroupMemberId" => "
				SELECT
					*
				FROM `Group_Member`
				WHERE groupMemberId=:groupMemberId ",
		];
	}

	private static function Update()
	{
		return [
			"byUserId" => "
				UPDATE
					`Group_Member`
				SET
					groupId=:groupId/**/
				WHERE userId=:userId/**/",

			"byGroupMemberId" => "
				UPDATE
					`Group_Member`
				SET
					groupId=:groupId/**/
				WHERE groupMemberId=:groupMemberId/**/",
		];
	}

	private static function Delete()
	{
		return "DELETE FROM `Group_Member` WHERE userId=:userId/**/";
	}
}
?>
