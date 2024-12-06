<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qKnowledge_File
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
			INSERT INTO `Knowledge_File`(
				knowledgeFileName
				,knowledgeFileType
				,knowledgeFileTmpName
				,knowledgeFileSize
				,knowledgeFilePath
				,knowledgeId
				,userId
			) VALUES (
				:knowledgeFileName/**/
				,:knowledgeFileType/**/
				,:knowledgeFileTmpName/**/
				,:knowledgeFileSize/**/
				,:knowledgeFilePath/**/
				,:knowledgeId/**/
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
				FROM `Knowledge_File`"
			,'byKnowledgeFileId' => "
				SELECT
					`Knowledge_File`.*
					,`User`.userName
				FROM `Knowledge_File`
				INNER JOIN `User` USING (userId)
				WHERE knowledgeFileId=:knowledgeFileId/**/"
			,'byKnowledgeId' => "
				SELECT
					`Knowledge_File`.*
					,`User`.userName
				FROM `Knowledge_File`
				INNER JOIN `User` USING (userId)
				WHERE knowledgeId=:knowledgeId/**/"
			,'byUserId' => "
				SELECT
					userId
				FROM `Knowledge_File`
				WHERE userId=:userId/**/"
		);
	}
	
	private static function Update()
	{
		return "";
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Knowledge_File` WHERE knowledgeFileId=:knowledgeFileId/**/";
	}
}