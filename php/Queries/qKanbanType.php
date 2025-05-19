<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\{Log, Check, Valid};

class qKanbanType
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
            "All" => "
                SELECT
                    `KanbanType`.kanbanTypeId,
                    `KanbanType`.kanbanTypeName
                FROM `KanbanType`",
            "List" => "
                SELECT
                    `KanbanType`.kanbanTypeId,
                    `KanbanType`.kanbanTypeList
                FROM `KanbanType`",
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
