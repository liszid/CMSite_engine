<?php
declare(strict_types=1);
namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

abstract class AbstractDatabase
{
	public static function Get(): array
    {
		return array(
			'Create' => self::Create()
			,'Insert' => self::Insert()
			,'Select' => self::Select()
		);
	}

	private static function Create()	{ return static::CREATE;	}
	private static function Insert()	{ return static::INSERT;	}
	private static function Select()	{ return static::SELECT;	}
}

switch($GLOBALS['Database']['type']) {
    case 'oracle':
        class qDatabase extends AbstractDatabase implements 
            qDatabase\oracle\SELECT, 
            qDatabase\oracle\INSERT, 
            qDatabase\oracle\CREATE 
        {
        }
        break;
    case 'mysql':
        class qDatabase extends AbstractDatabase implements 
            qDatabase\mysql\SELECT, 
            qDatabase\mysql\INSERT, 
            qDatabase\mysql\CREATE 
        {
        }
        break;
}
?>