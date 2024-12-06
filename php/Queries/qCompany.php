<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qCompany
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
			INSERT INTO `Company`(
				userId
				,companyName
				,companyDesc
			) VALUES (
				:userId/**/
				,:companyName/**/
				,:companyDesc/**/
			);
		";
	}
	
	private static function Select()
	{
		return array(
			'All' => "
				SELECT
					`Company`.*
					,`User`.userName
				FROM `Company`
				INNER JOIN `User` USING (userId)"
			,'byCompanyId' => "
				SELECT
					`Company`.*
					,`User`.userName
				FROM `Company`
				INNER JOIN `User` USING (userId)
				WHERE companyId=:companyId/**/"
			,'forCompanySelect' => "
				SELECT
					companyId
					,companyName
				FROM `Company`"
			,'byUserId' => "
				SELECT
					userId
				FROM `Company`
				WHERE userId=:userId/**/"
		);
	}
	
	private static function Update()
	{
		return "
			UPDATE
				`Company`
			SET
				companyName=:companyName/**/
				,companyDesc=:companyDesc/**/ 
				,companyTaxNumber=:companyTaxNumber/**/
				,companyRegisteredNumber=:companyRegisteredNumber/**/
				,companyAddressCity=:companyAddressCity/**/
				,companyAddressPostcode=:companyAddressPostcode/**/ 
				,companyAddressStreet=:companyAddressStreet/**/
			WHERE
				companyId=:companyId/**/
		";
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Company` WHERE companyId=:companyId/**/";
	}
}