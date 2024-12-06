<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qKnowledge_Type
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
			INSERT INTO `Knowledge_Type`(
				knowledgeTypeName
			) VALUES (
				:knowledgeTypeName/**/
			);
		";
	}

	private static function Select()
	{
		return array(
			'All' => "
				SELECT
					*
				FROM `Knowledge_Type`"
            ,'byKnowledgeTypeId' => "
                SELECT
                    *
                FROM `Knowledge_Type`
                WHERE knowledgeTypeId=:knowledgeTypeId/**/
            "
		);
	}

	private static function Update()
	{
		return "
            UPDATE
                `Knowledge_Type`
            SET
                knowledgeTypeName=:knowledgeTypeName/**/
            WHERE
                knowledgeTypeId=:knowledgeTypeId/**/";
	}

	private static function Delete()
	{
		return "";
	}
}
