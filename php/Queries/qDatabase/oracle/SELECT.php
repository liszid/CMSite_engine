<?php

declare(strict_types=1);

namespace Queries\qDatabase\oracle;

interface SELECT
{
	const SELECT = [
		"Database" => "
			 		SELECT USERNAME FROM ALL_USERS WHERE USERNAME = 'cap_mngmt'",
		"Table" => "
                    SELECT TABLE_NAME FROM ALL_TABLES WHERE OWNER = :sqlDB/**/ AND TABLE_NAME = :tableName/**/",
	];
}
?>
