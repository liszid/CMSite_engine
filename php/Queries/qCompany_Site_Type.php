<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qCompany_Site_Type
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
			INSERT INTO `Company_Site_Type`(
				companySiteTypeName
			) VALUES (
				:companySiteTypeName/**/
			);
		";
	}

	private static function Select()
	{
		return array(
			'All' => "
				SELECT
					*
				FROM `Company_Site_Type`"
            ,'byCompanySiteTypeId' => "
                SELECT
                    *
                FROM `Company_Site_Type`
                WHERE companySiteTypeId=:companySiteTypeId/**/ 
            "
		);
	}

	private static function Update()
	{
		return "
            UPDATE
                `Company_Site_Type`
            SET
                companySiteTypeName=:companySiteTypeName/**/ 
            WHERE
                companySiteTypeId=:companySiteTypeId/**/";
	}

	private static function Delete()
	{
		return "DELETE FROM `Company_Site_Type` WHERE companySiteTypeId=:companySiteTypeId/**/";
	}
}
