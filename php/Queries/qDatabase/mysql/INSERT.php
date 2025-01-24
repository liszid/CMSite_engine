<?php

declare(strict_types=1);

namespace Queries\qDatabase\mysql;

interface INSERT
{
     const INSERT = array(
         0 => "
			INSERT INTO `User`(
				userName, pWord, userThumbnail, userFirstName, userLastName, userContEmail, userContPhone, userContSite, isDelete
			) VALUES
				('root', md5('root'), 'cogs', 'Root', '', 'admin@plfmnag.hu/', '0036201234567', 'Budapest', 0)"
		,1 => "
			INSERT INTO `Group`(
				groupName, groupDesc, canAdministrative, mngGroups, mngHuntgroups, mngUsers, mngTools, canUsers, canEdit, canLogin, isDelete
			) VALUES
				 ('Adminisztrátor',	 'Adminisztratív jogosultság',                       1, 1, 1, 1, 1, 1, 1, 1, 0)
				,('Alapértelmezett', 'Alapértelmezett jogosultság',                      0, 0, 0, 0, 0, 1, 1, 1, 0)
				,('Korlátozott',     'Korlátozott hozzáféréssel rendelkezö jogosultság', 0, 0, 0, 0, 0, 1, 1, 1, 0)
				,('Törölt',          'Törölt felhasználók jogosultsága',                 0, 0, 0, 0, 0, 0, 0, 0, 0)"
		,2 => "
			INSERT INTO `Group_Member`(
				userId, groupId, isDelete
			) VALUES
				(1, 1, 0);"
		,3 => "
			INSERT INTO `Huntgroup`(
				huntgroupName, huntgroupDesc, isDelete
			) VALUES
				('Alapértelmezett', 'Alapértelmezett adatok gyüjtő csoportja', 0)
				,('#_admin', '', 0);"
		,4 => "
			INSERT INTO `Huntgroup_Member`(
				userId, huntgroupId, isDelete
			) VALUES
				(1, 1, 0)
				,(1, 2, 0);"
     );
}

?>