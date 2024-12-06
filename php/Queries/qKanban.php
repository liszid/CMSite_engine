<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qKanban
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
            INSERT INTO `Kanban`(
                kanbanTitle
                ,kanbanTypeId
                ,kanbanText
                ,kanbanLabel
                ,userId
                ,companyId
            ) VALUES (
                :kanbanTitle/**/
                ,:kanbanTypeId/**/
                ,:kanbanText/**/
                ,:kanbanLabel/**/
                ,:userId/**/
                ,:companyId/**/
            );
        ";
    }

    private static function Select()
    {
        return array(
            'byKanbanState' => "
                SELECT
                    `Kanban`.*
                    ,`User`.userName
                FROM `Kanban`
                WHERE userId=:userId/**/
                    AND kanbanState=:kanbanState/**/ "
            ,'byKanbanId' => "
                SELECT
                    `Kanban`.*
                    ,`User`.userName
                FROM `Kanban`
                INNER JOIN `User` USING (userId)
                WHERE kanbanId=:kanbanId/**/"
            ,'byUserId' => "
                SELECT
                    userId
                FROM `Kanban`
                WHERE userId=:userId/**/"
            ,'lastInsert' => "
                SELECT
                    kanbanId
                FROM `Kanban`
                WHERE userId=:userId/**/
                ORDER BY kanbanId DESC
                LIMIT 1"
        );
    }

    private static function Update()
    {
        return "
            UPDATE
                `Kanban`
            SET
                kanbanTypeId=:kanbanTypeId/**/
                ,kanbanTitle=:kanbanTitle/**/
                ,kanbanText=:kanbanText/**/
                ,kanbanLabel=:kanbanLabel/**/
                ,companyId=:companyId/**/
            WHERE
                kanbanId=:kanbanId/**/
            ";
    }

    private static function Delete()
    {
        return "DELETE FROM `Kanban` WHERE kanbanId=:kanbanId/**/";
    }
}