<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qHardware
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
			INSERT INTO `Hardware` (
                hardwareName
                ,hardwareDesc
                ,hardwarePrice
                ,hardwareDateIn
                ,hardwareGuaranteeDate
                ,hardwareDate
                ,userId
                ,companySiteId
            )  VALUES (
				:hardwareName/**/
				,:hardwareDesc/**/
				,:hardwarePrice/**/
				,:hardwareDateIn/**/
				,:hardwareGuaranteeDate/**/
				,:hardwareDate/**/
				,:userId/**/
				,:companySiteId/**/
			);
		";
	}
	
	private static function Select()
	{
		return array(
			'All' => "
				SELECT
					`Hardware`.*
					,`Company_Site`.companySiteName
				FROM `Company_Site`
				INNER JOIN `Hardware` USING (companySiteId)"
			,'byHardwareId' => "
				SELECT
					`Hardware`.*
					,`User`.userName
				FROM `Hardware`
				LEFT JOIN `User` USING (userId)
				WHERE hardwareId=:hardwareId/**/"
			,'byUserId_Last' => "
				SELECT
					hardwareId
				FROM `Hardware`
				WHERE userId=:userId/**/
				ORDER BY hardwareId DESC LIMIT 1"
			,'byUserId' => "
				SELECT
					userId
				FROM `Hardware`
				WHERE userId=:userId/**/"
		);
	}
	
	private static function Update()
	{
		return "
			UPDATE
				`Hardware`
			SET
				hardwareName=:hardwareName/**/
				,hardwareDesc=:hardwareDesc/**/
				,hardwarePrice=:hardwarePrice/**/
				,hardwareDateIn=:hardwareDateIn/**/
				,hardwareGuaranteeDate=:hardwareGuaranteeDate/**/
				,companySiteId=:companySiteId/**/
			WHERE
				hardwareId=:hardwareId/**/
		";
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Hardware` WHERE hardwareId=:hardwareId/**/";
	}
}