<?php

declare(strict_types=1);

namespace Database;

use \PDO;

use Toolkit\{
	Log
	,Check
	,Valid
};

class Database
{
    protected static $SQL;

    private static $conn = null;

    public function __construct()
    {
		self::$SQL = $GLOBALS['Database'];
		self::setConnection();
    }
/**
* Creates a PDO connection using \PDO class and returns a PDO object if true
*
* @param $dbName string
*
* @return bool
*
* @author Liszi Dániel
*/
    public static function setConnection(string $dbName = ''): bool
    {
        try {
            if ( empty($dbName) ) {
                self::$conn = new PDO("mysql:host=".self::$SQL['host'].";port=".self::$SQL['port'], self::$SQL['user'], self::$SQL['pass']);
            } else {
                self::$conn = new PDO("mysql:host=".self::$SQL['host'].";port=".self::$SQL['port'].";dbname=".$dbName, self::$SQL['user'], self::$SQL['pass']);
            }
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }

    public static function getConnection(): object
    {
        return self::$conn;
    }
/**
* Only for the initial queries
*
* @param $query string
*
* @return bool
*
* @author Liszi Dániel
*/
    private static function sqlQueriesDB(string $query): bool
    {
        self::setConnection();

        $statement = self::getConnection()->prepare($query);
        $statement->execute();

        return (intval($statement->rowCount()) === 1 )? true: false;
    }

/**
 * Returns true if database exists, false of failure
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    public static function initDatabase(): bool
    {
        $tableQueries = \Queries\qDatabase::Get();

        if (self::sqlQueriesDB($tableQueries['Select']['Database']) !== true) {
            return (self::sqlQueriesDB($tableQueries['Create']['Database']) === true) ? true : false;
        }
        return true;
    }
}
