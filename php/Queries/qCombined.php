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
		);
	}
	private static function Update() {
		return "";
	}
	private static function Delete() {
		return "";
	}
}
	