<?php

declare(strict_types=1);

namespace Database;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class dbGroup extends Table implements iDatabase
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
		return '';
	}
	
	private static function Select()
	{
		return 'SELECT * FROM SYM;';
	}
	
	private static function Update()
	{
		return '';
	}
	
	private static function Delete()
	{
		return '';
	}

}
?>