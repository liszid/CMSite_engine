<?php

declare(strict_types=1);

namespace Database;

use \PDO;

use Toolkit\{Log, Check, Valid};

class Queries extends Database
{
    private static $tableQueries = [];

    const TABLENAMES = [
        0 => "User",
        1 => "Group",
        2 => "Group_Member",
        3 => "Huntgroup",
        4 => "Huntgroup_Member",
        5 => 'Calendar',
        10 => "StorageId",
        11 => "StoragePhys",
        12 => "StorageTotal",
        13 => "StorageGroup",
        20 => "ComputerInfo",
        21 => "ProcessorInfo",
        22 => "MemoryModuleInfo",
        23 => "DiskDriveInfo",
        24 => "LogicalDiskInfo",
        25 => "NetworkAdapterInfo",
        26 => "NetworkConnectionInfo",
        27 => "BIOSInfo",
        28 => "VolumeInfo",
        29 => "MotherboardInfo",
        30 => "ThermalZoneInfo",
        // Jelszó tároló visszahozása, csoportosítás nélkül, jelszavakat egyenként lehessen megosztani
        // Jegyzetek visszahozása, melléklet nélkül
        // Streaming / Könyv wishlist
        99 => "Combined",
    ];
    
    /**
     * [[Description]]
     * @private
     * @author Daniel Liszi
     */
    public function __construct()
    {
        parent::__construct();

        self::$tableQueries = \Queries\qDatabase::Get();
    }
    
    /**
     * Generates array with queries related to Table
     * @param integer requires Id of the class, which is related to TABLENAMES
     * @return array all queries for DB tables
     * @author Daniel Liszi
     * @createDate 2020.11.04
     */
    public function qGet(int $classId): array
    {
        $returnArray = [];

        if (isset(self::TABLENAMES[$classId])) {
            $wClass = "\Queries\q" . self::TABLENAMES[$classId];
            $returnArray = $wClass::Get();
        }

        return $returnArray;
    }

    public static function qCheck(int $var): bool
    {
        if (isset(self::TABLENAMES[$var]) && isset(self::$SQL["db"])) {
            try {
                $tableName = self::TABLENAMES[$var];

                self::setConnection(self::$SQL["db"]);
                $statement = self::getConnection()->prepare(self::$tableQueries["Select"]["Table"]);
                $statement->bindParam(":sqlDB", self::$SQL["db"]);
                $statement->bindParam(":tableName", $tableName);
                $statement->execute();
                return $statement->rowCount() === 0;
            } catch (PDOException $e) {
                return false;
            }
        }
    }

    public static function qCreate(int $var): bool
    {
        if (isset(self::$tableQueries["Create"][$var])) {
            try {
                self::setConnection(self::$SQL["db"]);
                $statement = self::getConnection()->prepare(self::$tableQueries["Create"][$var]);
                $statement->execute();
                return $statement->errorInfo()[0] === "00000";
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function qInsert(int $var): bool
    {
        if (isset(self::$tableQueries["Insert"][$var])) {
            try {
                self::setConnection(self::$SQL["db"]);
                $statement = self::getConnection()->prepare(self::$tableQueries["Insert"][$var]);
                $statement->execute();
                return $statement->rowCount() > 0;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function qGetVNames(string $query): array
    {
        $returnArray = [];
        $tempArray = explode(":", $query);
        for ($i = 1; $i < count($tempArray); $i++) {
            $returnArray[] = explode("/", trim($tempArray[$i]))[0];
        }
        return $returnArray;
    }

    public static function qRun(array $array): object
    {
        try {
            self::setConnection(self::$SQL["db"]);
            $statement = self::getConnection()->prepare($array["query"]);
            foreach (self::qGetVNames($array["query"]) as $v) {
                if (isset($array["vData"][$v])) {
                    $statement->bindParam(":" . $v, $array["vData"][$v]);
                }
            }
            //Log::Export(self::qGetVNames($array['query']));
            $statement->execute();
            return $statement;
        } catch (PDOException $e) {
            return new stdClass();
        }
    }
}
?>
