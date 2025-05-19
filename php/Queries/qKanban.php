<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\{Log, Check, Valid};

class qKanban
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
    /*
     *  kanbanId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
     *  kanbanTypeId INT(6) UNSIGNED NOT NULL,
     *  kanbanTitle VARCHAR(128) NULL,
     *  kanbanText LONGTEXT NULL,
     *  userId INT(6) UNSIGNED NOT NULL,
     *  isDelete INT(1) DEFAULT 1,
     * */
    private static function Insert()
    {
        return "
            INSERT INTO `Kanban`(
                kanbanTitle
                ,kanbanTypeId
                ,kanbanText
                ,userId
            ) VALUES (
                :kanbanTitle/**/
                ,:kanbanTypeId/**/
                ,:kanbanText/**/
                ,:userId/**/
            );
        ";
    }

    private static function Select()
    {
        return [
            "All" => "
                SELECT
                    `Kanban`.*
                    ,`KanbanType`.kanbanTypeName
                FROM `Kanban`
                INNER JOIN `KanbanType` USING (kanbanTypeId)
                WHERE userId=:userId/**/
                ORDER BY kanbanTypeId ASC",
            "byId" => "
                SELECT
                    `Kanban`.*
                    ,`KanbanType`.kanbanTypeName
                FROM `Kanban`
                INNER JOIN `KanbanType` USING (kanbanTypeId)
                WHERE kanbanId=:kanbanId/**/
                ORDER BY kanbanTypeId ASC",
        ];
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
            WHERE
                kanbanId=:kanbanId/**/
            ";
    }

    private static function Delete()
    {
        return "DELETE FROM `Kanban` WHERE kanbanId=:kanbanId/**/";
    }
}
