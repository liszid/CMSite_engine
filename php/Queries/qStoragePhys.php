<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\{Log, Check, Valid};

class qStoragePhys
{
	public static function Get(): array
	{
		return [
			"Insert" => self::Insert(),
			"Select" => self::Select(),
			"Update" => self::Update(),
			"Delete" => self::Delete(),
		];
	}

	private static function Insert()
	{
		return "";
	}

	private static function Select()
	{
		return [
			"All" => '
				SELECT si.sym_id, si.srp_name, sp.*
				FROM StoragePhys sp
				JOIN StorageId si ON sp.storage_id = si.storage_id;',
			"byId" => '
                SELECT si.sym_id, si.srp_name, sp.*
				FROM StoragePhys sp
				JOIN StorageId si ON sp.storage_id = si.storage_id
				WHERE sp.sphys_id=:sphys_id/**/;',
		];
	}

	private static function Update()
	{
		return "";
	}

	private static function Delete()
	{
		return "";
	}
}
?>
