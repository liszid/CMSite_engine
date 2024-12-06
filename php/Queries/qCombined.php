<?php
declare(strict_types = 1);
namespace Queries;
use Toolkit\ {
	Log, Check, Valid
};
class qCombined {
	public static function Get(): array
	{
		return array('Insert' => self::Insert(), 'Select' => self::Select(), 'Update' => self::Update(), 'Delete' => self::Delete());
	}
	private static function Insert()
	{
			return "";
	}
	private static function Select()
	{
		return array(
			'User_Full' => "
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
				    ,`Group`.*
				FROM `User`
				INNER JOIN `Group_Member` USING (userId)
				INNER JOIN `Group` USING (groupId)
				WHERE `User`.userId=:userId/**/"
			, 'Member_Full' => "
				SELECT
				    `User`.userId
				    ,`Group_Member`.groupMemberId
				    ,`Group`.groupName
				    ,`Group`.groupDesc
				    ,`User`.userName
				    ,`User`.isDelete
				FROM `User`
				INNER JOIN `Group_Member` USING (userId)
				INNER JOIN `Group` USING (groupId)"
			,'Huntgroup_Members' => "
				SELECT
				    `Huntgroup_Member`.huntgroupMemberId
				    ,`Huntgroup`.huntgroupName
				    ,`Huntgroup`.huntgroupDesc
				    ,`User`.userName
				    ,`User`.userId
				    ,`Huntgroup_Member`.isDelete
				FROM `User`
				INNER JOIN `Huntgroup_Member` USING (userId)
				INNER JOIN `Huntgroup` USING (huntgroupId)
				WHERE `Huntgroup`.huntgroupId=:huntgroupId/**/"
			, 'User_Huntgroups' => "
				SELECT
				    `Huntgroup`.huntgroupName
				FROM `Huntgroup_Member`
				INNER JOIN `Huntgroup` USING (huntgroupId)
				WHERE `Huntgroup_Member`.userId=:userId/**/
				ORDER BY `Huntgroup`.huntgroupName ASC"
			,'Company_Site_Table' => "
				SELECT
				    `Company`.companyName
				    ,`Company_Site_Type`.companySiteTypeName
				    ,`Company_Site`.*
				FROM `Company_Site`
				INNER JOIN `Company_Site_Type` USING (companySiteTypeId)
				INNER JOIN `Company` USING (companyId)"
			,'Company_Site_View' => "
				SELECT
				    `Company_Site`.*
				    ,`Company`.*
				    ,`Company_Site_Type`.companySiteTypeName
				    ,`User`.userName
				FROM `Company_Site`
				INNER JOIN `User` USING (userId)
				INNER JOIN `Company_Site_Type` USING (companySiteTypeId)
				INNER JOIN `Company` USING (companyId)
				WHERE companySiteId=:companySiteId/**/"
			,'Company_Filter_Company_Site' => "
				SELECT
				    `Company_Site`.*
				    ,`Company_Site_Type`.companySiteTypeName
				    ,`Company`.companyId
				    ,`Company`.companyName
				    ,`Company`.companyDesc
				    ,`Company`.companyTaxNumber
				    ,`Company`.companyRegisteredNumber
				    ,`Company`.companyAddressCity
				    ,`Company`.companyAddressPostcode
				    ,`Company`.companyAddressStreet
				    ,`User`.userName
				FROM `Company_Site`
				INNER JOIN `User` USING (userId)
				INNER JOIN `Company_Site_Type` USING (companySiteTypeId)
				INNER JOIN `Company` USING (companyId)
				WHERE `Company_Site`.companyId=:companyId/**/"
			,'Company_Filter_Passtorage' => "
				SELECT
				    `Passtorage`.*
				FROM `Passtorage`
				INNER JOIN `Company_Site` USING (companySiteId)
				WHERE `Company_Site`.companyId=:companyId/**/"
			,'Company_Filter_Knowledge' => "
				SELECT
				    *
				FROM `Knowledge`
				WHERE companyId=:companyId/**/"
			,'Company_Filter_Device' => "
				SELECT
				    `Hardware`.*
				FROM `Hardware`
				INNER JOIN `Company_Site` USING (companySiteId)
				WHERE `Company_Site`.companyId=:companyId/**/"
			, 'Company_Site_Select' => "
				SELECT
				    `Company_Site`.companySiteId
				    ,`Company_Site`.companySiteName
				    ,`Company`.companyName
				FROM `Company_Site`
				INNER JOIN `Company` USING (companyId)"
			,'Passtorage_Members' => "
				SELECT
				    `Passtorage_Member`.passtorageMemberId
				    ,`Huntgroup`.huntgroupId
				    ,`Huntgroup`.huntgroupName
				    ,`Huntgroup`.huntgroupDesc
				    ,`Passtorage`.passtorageName
				    ,`Passtorage`.passtorageId
				    ,`Passtorage_Member`.isDelete
				FROM `Passtorage`
				INNER JOIN `Passtorage_Member`USING (passtorageId)
				INNER JOIN `Huntgroup` USING (huntgroupId)
				WHERE `Passtorage`.passtorageId=:passtorageId/**/"
			,'Passtorage_Members_All' => "
				SELECT
				    `Passtorage`.*
				    ,`Company_Site`.companySiteName
				    ,`Company`.companyName
				FROM `Passtorage`
				INNER JOIN `Company_Site` USING (companySiteId)
				INNER JOIN `Company` USING (companyId)
				LEFT JOIN `Passtorage_Member` USING (passtorageId)
				LEFT JOIN `Huntgroup` USING (huntgroupId)
				LEFT JOIN `Huntgroup_Member` USING (huntgroupId)
				WHERE
				    `Huntgroup_Member`.userId=:userId/**/
				    OR `Passtorage`.userId=:userId/**/
				GROUP BY `Passtorage`.passtorageId"
			,'Passtorage_Members_Select' => "
				SELECT
				    `Passtorage`.*
				    ,`Company_Site`.companySiteName
				    ,`Company`.companyName
				FROM `Passtorage`
				INNER JOIN `Company_Site` USING (companySiteId)
				INNER JOIN `Company` USING (companyId)
				LEFT JOIN `Passtorage_Member` USING (passtorageId)
				LEFT JOIN `Huntgroup` USING (huntgroupId)
				LEFT JOIN `Huntgroup_Member` USING (huntgroupId)
				WHERE
				    (`Huntgroup_Member`.userId=:userId/**/
					OR `Passtorage`.userId=:userId/**/)
				GROUP BY `Passtorage`.passtorageId"
			,'Access_Table' => "
				SELECT
				    `Access`.accessId
				    ,`Passtorage`.passtorageId
				    ,`Passtorage`.passtorageName
				    ,`Access`.accessLabel
				    ,`Access`.accessLink
				    ,`Access`.accessUsername
				    ,`Company`.companyName
				    ,`Company_Site`.companySiteName
				    ,`User`.userName
				    ,`Access`.isDelete
				FROM `Access`
				INNER JOIN `Passtorage` USING (passtorageId)
				INNER JOIN `User` ON `User`.userId = `Access`.userId
				INNER JOIN `Company_Site` USING (companySiteId)
				INNER JOIN `Company` USING (companyId)
				LEFT JOIN `Passtorage_Member` USING (passtorageId)
				LEFT JOIN `Huntgroup` USING (huntgroupId)
				LEFT JOIN `Huntgroup_Member` USING (huntgroupId)
				WHERE
				    `Huntgroup_Member`.userId=:userId/**/
				    OR `Access`.userId=:userId/**/
				GROUP BY `Access`.accessId"
			,'Knowledge_Table' => "
				SELECT
				    `Knowledge`.*
				    ,`Knowledge_Type`.knowledgeTypeName
				    ,`Company`.companyName
				    ,`User`.userName
				FROM `Knowledge`
				INNER JOIN `User` USING (userId)
				INNER JOIN `Company` USING (companyId)
				INNER JOIN `Knowledge_Type` USING (knowledgeTypeId)"
			,'Hardware_Members' => "
				SELECT
				    `Hardware_Member`.hardwareMemberId
				    ,`Huntgroup`.huntgroupId
				    ,`Huntgroup`.huntgroupName
				    ,`Huntgroup`.huntgroupDesc
				    ,`Hardware`.hardwareName
				    ,`Hardware`.hardwareId
				    ,`Hardware_Member`.isDelete
				FROM `Hardware`
				INNER JOIN `Hardware_Member`USING (hardwareId)
				INNER JOIN `Huntgroup` USING (huntgroupId)
				WHERE `Hardware`.hardwareId=:hardwareId/**/"
			,'Hardware_Members_All' => "
				SELECT
				    `Hardware`.hardwareId
					,`Hardware`.hardwareName
					,`Hardware`.hardwareDesc
					, CONCAT(`Hardware`.hardwarePrice, ' HUF') as hardwarePrice
					,`Hardware`.hardwareDateIn
					,`Hardware`.hardwareGuaranteeDate
					,`Hardware`.hardwareDate
					,`Hardware`.userId
					,`Hardware`.companySiteId
					,`Hardware`.isDelete
				    ,`Company_Site`.companySiteName
				    ,`Company`.companyName
				FROM `Hardware`
				INNER JOIN `Company_Site` USING (companySiteId)
				INNER JOIN `Company` USING (companyId)
				LEFT JOIN `Hardware_Member` USING (hardwareId)
				LEFT JOIN `Huntgroup` USING (huntgroupId)
				LEFT JOIN `Huntgroup_Member` USING (huntgroupId)
				WHERE
				    `Huntgroup_Member`.userId=:userId/**/
				    OR `Hardware`.userId=:userId/**/
				GROUP BY `Hardware`.hardwareId"
			,'Hardware_Members_Select' => "
				SELECT
				    `Hardware`.*
				    ,`Company_Site`.companySiteName
				    ,`Company`.companyName
				FROM `Hardware`
				INNER JOIN `Company_Site` USING (companySiteId)
				INNER JOIN `Company` USING (companyId)
				LEFT JOIN `Hardware_Member` USING (hardwareId)
				LEFT JOIN `Huntgroup` USING (huntgroupId)
				LEFT JOIN `Huntgroup_Member` USING (huntgroupId)
				WHERE
				    (`Huntgroup_Member`.userId=:userId/**/
					OR `Hardware`.userId=:userId/**/)
				    AND `Hardware`.hardwareType=:hardwareType/**/
				GROUP BY `Hardware`.hardwareId"
		);
	}
	private static function Update() {
		return "";
	}
	private static function Delete() {
		return "";
	}
}
	