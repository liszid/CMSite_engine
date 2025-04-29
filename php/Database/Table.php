<?php

declare(strict_types=1);

namespace Database;

use \PDO;

use Toolkit\{Log, Check, Valid};

class Table extends Queries
{
    /**
     * Construct functions, enables to access initTable()
     * @private
     * @author Daniel Liszi
     * @createDate 11/04/2020
     * @lastmodifiedBy Daniel Liszi
     * @lastmodifiedDate 04/22/2025
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Checks if DB Table exists, if not, it will create table and insert default data if exists
     * @public
     * @return boolean Returns if table initialization was successfull or not
     * @author Daniel Liszi
     * @createDate 11/04/2020
     * @lastmodifiedBy Daniel Liszi
     * @lastmodifiedDate 04/22/2025
     */
    public static function initTable(): bool
    {
        if (!isset($_SESSION["Database"])) {
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
