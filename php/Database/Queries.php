<?php

declare(strict_types=1);

namespace Database;

use \PDO;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class Queries extends Database
{
    private static $tableQueries = array();

    const TABLENAMES = array(
            0 => 'User'
            ,1 => 'Group'
            ,2 => 'Group_Member'
            ,3 => 'Huntgroup'
            ,4 => 'Huntgroup_Member'
            ,10 => 'Symmetrix'
            ,11 => 'SRP'
            ,12 => 'SG_Info'
            ,13 => 'SG_View'
            ,14 => 'SG_Total'
            ,90 => 'Log'
            ,98 => 'Tools'
            ,99 => 'Combined'
        );

	public function __construct()
    {
        parent::__construct();

        self::$tableQueries = \Queries\qDatabase::Get();
    }

/**
 * Sets array to have class specific queries
 *
 * @param $array array
 * @param $classid int
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    public function qGet(int $classId): array
    {
        $returnArray = array();

		if (isset(self::TABLENAMES[$classId])) {
			$wClass = '\Queries\q'.self::TABLENAMES[$classId];
			$returnArray = $wClass::Get();
		}

        return $returnArray;
    }

/**
 * Fires queries based on type (qCheck, qCreate, qInsert)
 *
 * @param $var int
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    public static function qCheck(int $var): bool
    {
        if (isset(self::TABLENAMES[$var]) && isset(self::$SQL['db'])) {
            try {
                $tableName = self::TABLENAMES[$var];

                self::setConnection(self::$SQL['db']);
                    $statement = self::getConnection()->prepare(self::$tableQueries['Select']['Table']);
                    $statement->bindParam(':sqlDB', self::$SQL['db']);
                    $statement->bindParam(':tableName', $tableName);
                    $statement->execute();
                return ($statement->rowCount() === 0);
            } catch (PDOException $e) {
                return false;
            }
        }
    }

    public static function qCreate(int $var): bool
    {
        if (isset(self::$tableQueries['Create'][$var])) {
            try {
                self::setConnection(self::$SQL['db']);
                    $statement = self::getConnection()->prepare(self::$tableQueries['Create'][$var]);
                    $statement->execute();
                return (($statement->errorInfo())[0] === '00000');
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }

	public static function qInsert(int $var): bool
	{
		if (isset(self::$tableQueries['Insert'][$var])) {
			try {
				self::setConnection(self::$SQL['db']);
				$statement = self::getConnection()->prepare(self::$tableQueries['Insert'][$var]);
				$statement->execute();
				return ($statement->rowCount() > 0);
			} catch (PDOException $e) {
				return false;
			}
		} else {
			return false;
		}
	}
    
	public static function qGetVNames(string $query): array
	{
		$returnArray = array();
		$tempArray = explode(':', $query);
		for ($i = 1; $i < count($tempArray); $i++) {
			$returnArray[] = explode('/', trim($tempArray[$i]))[0];
		}
		return $returnArray;
	}
/**
 * Query runner function, with Logging function added
 *
 * @param $array array
 *
 * @return PDOobject
 *
 * @author Liszi Dániel
 */
    public static function qRun(array $array): object
    {
        try {
            self::setConnection(self::$SQL['db']);
            $statement = self::getConnection()->prepare($array['query']);
            foreach (self::qGetVNames($array['query']) as $v) {
                if (isset($array['vData'][$v])) {
                    $statement->bindParam(':'.$v,  $array['vData'][$v]);
                }
            }
            //Log::Export(self::qGetVNames($array['query']));
            $statement->execute();
            return $statement;
        } catch(PDOException $e) {
            return new stdClass();
        }
    }
}