<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qTools
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
		return '';
	}
	
	private static function Update()
	{
		return '';
	}
	
	private static function Delete()
	{
		return array(
			'Database' => "DROP DATABASE `plfmnag`"
		);
	}
}