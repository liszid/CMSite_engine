<?php

declare(strict_types=1);

namespace Queries\qDatabase\mysql;

interface SELECT
{
     const SELECT = array(
         'Database' => "
            SELECT
                SCHEMA_NAME
            FROM
                INFORMATION_SCHEMA.SCHEMATA
            WHERE
                SCHEMA_NAME = 'plfmnag'",
        'Table' => "
            SELECT
                TABLE_NAME
            FROM
                INFORMATION_SCHEMA.TABLES
            WHERE
                TABLE_SCHEMA=:sqlDB/**/
                AND TABLE_NAME=:tableName/**/"
     );
}

?>