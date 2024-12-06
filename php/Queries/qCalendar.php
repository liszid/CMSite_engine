<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qCalendar
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
			INSERT INTO `Calendar`(
				userId
                , eventTitle
                , eventDescription
                , eventStartDate
                , eventEndDate
			) VALUES (
			    :userId/**/
                , :eventTitle/**/
                , :eventDescription/**/
                , :eventStartDate/**/
                , :eventEndDate/**/
			);
		";
	}
	
	private static function Select()
	{
		return array(
			'byUserId' => "
				SELECT
					*
				FROM `Calendar`
				WHERE userId=:userId/**/"
		);
	}
	
	private static function Update()
	{
		return "
			UPDATE
				`Calendar`
			SET
			    eventTitle=:eventTitle/**/
                , eventDescription=:eventDescription/**/
                , eventStartDate=:eventStartDate/**/
                , eventEndDate=:eventEndDate/**/
                , eventColor=:eventColor/**/
                , eventEveryYear=:eventEveryYear/**/
			WHERE
				eventId=:eventId/**/
		";
	}
	
	private static function Delete()
	{
		return "DELETE FROM `Calendar` WHERE eventId=:eventId/**/";
	}
}