<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qCompany_Site
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
			INSERT INTO `Company_Site`(
				userId
				,companyId
				,companySiteName
				,companySiteDesc
				,companySiteTypeId
			) VALUES (
				:userId/**/
				,:companyId/**/ 
				,:companySiteName/**/ 
				,:companySiteDesc/**/
				,:companySiteTypeId/**/ 
			);
		";
	}
	
	private static function Select()
	{
		return array(
			'All' => "
				SELECT
					*
				FROM `Company_Site`"
			,'byCompanyId' => "
				SELECT
					*
				FROM `Company_Site`
				WHERE companyId=:companyId/**/"
			,'byCompanySiteId' => "
				SELECT
					*
				FROM `Company_Site`
				WHERE companySiteId=:companySiteId/**/"
			,'byUserId' => "
				SELECT
					userId
				FROM `Company_Site`
				WHERE userId=:userId/**/"
		);
	}
	
	private static function Update()
	{
		return "
			UPDATE
				`Company_Site`
			SET
				companySiteDesc=:companySiteDesc/**/ 
				,companySiteOwnerFirstName=:companySiteOwnerFirstName/**/ 
				,companySiteOwnerLastName=:companySiteOwnerLastName/**/
				,companySiteOwnerEmail=:companySiteOwnerEmail/**/
				,companySiteOwnerPhone=:companySiteOwnerPhone/**/ 
				,companySiteSubOwnerFirstName=:companySiteSubOwnerFirstName/**/ 
				,companySiteSubOwnerLastName=:companySiteSubOwnerLastName/**/
				,companySiteSubOwnerEmail=:companySiteSubOwnerEmail/**/
				,companySiteSubOwnerPhone=:companySiteSubOwnerPhone/**/ 
				,companySiteAddressCity=:companySiteAddressCity/**/
				,companySiteAddressPostcode=:companySiteAddressPostcode/**/ 
				,companySiteAddressStreet=:companySiteAddressStreet/**/
				,companySiteEmail=:companySiteEmail/**/
				,companySitePhone=:companySitePhone/**/ 
				,companySiteTypeId=:companySiteTypeId/**/ 
			WHERE
				companySiteId=:companySiteId/**/
		";
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Company_Site` WHERE companySiteId=:companySiteId/**/";
	}
}