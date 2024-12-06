<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qGroup
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
			INSERT INTO `Group`(
				groupName
				,groupDesc
			) VALUES (
				:groupName/**/
				,:groupDesc/**/
			);
		";
	}
	
	private static function Select()
	{
		return array(
			'All' => "
				SELECT
					*
				FROM `Group`"
			,'byGroupId' => "
				SELECT
					*
				FROM `Group`
				WHERE groupId=:groupId/**/"
			,'forMemberEdit' => "
				SELECT
					groupId
					,groupName
					,groupDesc
				FROM `Group`"
		);
	}
	
	private static function Update()
	{
		return "
			UPDATE
				`Group`
			SET
				canAdministrative=:canAdministrative/**/
				,mngGroups=:mngGroups/**/
				,mngUsers=:mngUsers/**/
				,mngHuntgroups=:mngHuntgroups/**/
				,mngTools=:mngTools/**/
				,canUsers=:canUsers/**/
				,canEdit=:canEdit/**/
				,canLogin=:canLogin/**/
			WHERE
				groupId=:groupId/**/";
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Group` WHERE groupId=:groupId/**/";
	}
}