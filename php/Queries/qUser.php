<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qUser
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
			INSERT INTO `User`(
				userName
				,pWord
				,userContEmail
			) VALUES (
				:userName/**/
				,:pWord/**/
				,:userContEmail/**/
			);
		";
	}
	
	private static function Select()
	{
		return array(
			'All' => "
				SELECT
					`User`.userId
					,`User`.userName
					,`User`.userFirstName
					,`User`.userLastName
					,`User`.userContEmail
					,`User`.userContPhone
					,`User`.userContSite
					,`User`.userThumbnail
					,`User`.isDelete
				FROM `User`"
			,'byUserName' => "
				SELECT
					`User`.userId
					,`User`.userId
					,`User`.userName
					,`User`.userFirstName
					,`User`.userLastName
					,`User`.userContEmail
					,`User`.userContPhone
					,`User`.userContSite
					,`User`.userThumbnail
					,`User`.isDelete
				FROM `User`
				WHERE userName=:userName/**/"
			,'byUserId' => "
				SELECT
					`User`.userId
					,`User`.userId
					,`User`.userName
					,`User`.userFirstName
					,`User`.userLastName
					,`User`.userContEmail
					,`User`.userContPhone
					,`User`.userContSite
					,`User`.userThumbnail
					,`User`.isDelete
				FROM `User`
				WHERE userId=:userId/**/"
			,'byContEmail' => "
				SELECT
					`User`.userId
					,`User`.userId
					,`User`.userName
					,`User`.userFirstName
					,`User`.userLastName
					,`User`.userContEmail
					,`User`.userContPhone
					,`User`.userContSite
					,`User`.userThumbnail
					,`User`.isDelete
				FROM `User`
				WHERE userContEmail=:userContEmail/**/"
			,'Login' => "
				SELECT
					userId
				FROM `User`
				WHERE
					userName=:userName/**/
					AND pWord=:pWord/**/"
			,'Password' => "
				SELECT
					pWord
				FROM `User`
				WHERE userId=:userId/**/"
		);
	}
	
	private static function Update()
	{
		return array(
			"Edit" => "
				UPDATE
					`User`
				SET
					userFirstName=:userFirstName/**/
					,userLastName=:userLastName/**/
					,userContSite=:userContSite/**/
					,userContPhone=:userContPhone/**/
					,userThumbnail=:userThumbnail/**/
				WHERE
					userId=:userId/**/"
			,"Password" => "
				UPDATE
					`User`
				SET
					pWord=:pWord/**/
				WHERE
					userId=:userId/**/"
			,"Reset" => "
				UPDATE
					`User`
				SET
					pWord=MD5(userName)
				WHERE
					userId=:userId/**/"
		);
	}
	
	private static function Delete()
	{
		return "DELETE FROM `User` WHERE userId=:userId/**/";
	}
}