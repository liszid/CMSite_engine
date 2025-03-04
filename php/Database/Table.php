<?php

declare(strict_types=1);

namespace Database;

use \PDO;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class Table extends Queries
{
    public function __construct()
    {
        parent::__construct();
    }

/**
 * Initial check on database, creates tables and default data
 *
 * @return true
 *
 * @author Liszi Dániel
 */
    public static function initTable(): bool
    {
        if (! isset($_SESSION['Database'])) {
            $tableQueries = \Queries\qDatabase::Get();
            //Ki kelllett szedni az initDatabase() feltételt
            foreach (self::TABLENAMES as $key => $query) {
                if (self::qCheck($key)) {
                    if (self::qCreate($key)) {
                        self::qInsert($key);
                    }
                }
            }
            return true;
        } else {
            return true;
        }
    }
}
?>