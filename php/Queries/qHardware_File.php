<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qHardware_File
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
			INSERT INTO `Hardware_File`(
				hardwareFileName
				,hardwareFileType
				,hardwareFileTmpName
				,hardwareFileSize
				,hardwareFilePath
				,hardwareId
				,userId
			) VALUES (
				:hardwareFileName/**/
				,:hardwareFileType/**/
				,:hardwareFileTmpName/**/
				,:hardwareFileSize/**/
				,:hardwareFilePath/**/
				,:hardwareId/**/
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
				FROM `Hardware_File`"
			,'byHardwareFileId' => "
				SELECT
					`Hardware_File`.*
					,`User`.userName
				FROM `Hardware_File`
				INNER JOIN `User` USING (userId)
				WHERE hardwareFileId=:hardwareFileId/**/"
			,'byHardwareId' => "
				SELECT
					`Hardware_File`.*
					,`User`.userName
				FROM `Hardware_File`
				INNER JOIN `User` USING (userId)
				WHERE hardwareId=:hardwareId/**/"
			,'byUserId' => "
				SELECT
					userId
				FROM `Hardware_File`
				WHERE userId=:userId/**/"
		);
	}
	
	private static function Update()
	{
		return '';
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Hardware_File` WHERE hardwareFileId=:hardwareFileId/**/";
	}
}