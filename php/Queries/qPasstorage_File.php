<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qPasstorage_File
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
			INSERT INTO `Passtorage_File`(
				passtorageFileName
				,passtorageFileType
				,passtorageFileTmpName
				,passtorageFileSize
				,passtorageFilePath
				,passtorageId
				,userId
			) VALUES (
				:passtorageFileName/**/
				,:passtorageFileType/**/
				,:passtorageFileTmpName/**/
				,:passtorageFileSize/**/
				,:passtorageFilePath/**/
				,:passtorageId/**/
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
				FROM `Passtorage_File`"
			,'byPasstorageFileId' => "
				SELECT
					`Passtorage_File`.*
					,`User`.userName
				FROM `Passtorage_File`
				INNER JOIN `User` USING (userId)
				WHERE passtorageFileId=:passtorageFileId/**/"
			,'byPasstorageId' => "
				SELECT
					`Passtorage_File`.*
					,`User`.userName
				FROM `Passtorage_File`
				INNER JOIN `User` USING (userId)
				WHERE passtorageId=:passtorageId/**/"
			,'byUserId' => "
				SELECT
					userId
				FROM `Passtorage_File`
				WHERE userId=:userId/**/"
		);
	}
	
	private static function Update()
	{
		return '';
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Passtorage_File` WHERE passtorageFileId=:passtorageFileId/**/";
	}
}