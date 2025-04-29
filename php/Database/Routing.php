<?php

declare(strict_types=1);

namespace Database;

use Toolkit\{Log, Check, Valid};

class Routing extends Table
{
    public $CLASS_ID;

    private $classQueries = [];

    const DB_ACT = [
        0 => ["Insert", "Select", "Update", "Delete"],  //User
        1 => ["Insert", "Select", "Update", "Delete"],  // Group              == Authorities
        2 => ["Insert", "Select", "Update", "Delete"],  // Group Member       == Authority assignment
        3 => ["Insert", "Select", "Update", "Delete"],  // Huntgroup          == Group
        4 => ["Insert", "Select", "Update", "Delete"],  // Huntgroup Member   == Group member
        5 => ["Insert", "Select", "Update", "Delete"],  // Calendar
        10 => ["Select"],                               // Storage ID
        11 => ["Select"],                               // Storage Phys
        12 => ["Select"],                               // Storage Total
        13 => ["Select"],                               // Storage Group
        99 => ["Select"],                               // Combined
    ];
    
    /**
     * Enables access to ID connected DB Tables by routing the requests
     * @public
     * @author Daniel Liszi
     * @param integer int $id database table ID
     * @createDate 04/16/2025
     * @lastmodifiedBy Daniel Liszi
     * @lastmodifiedDate 04/22/2025
     */
    public function __construct(int $id)
    {
        parent::__construct();
        $this->CLASS_ID = $id;
        $this->classQueries = self::qGet($this->CLASS_ID);
    }

    /**
     * Default DB Insert call
     * @public
     * @author Daniel Liszi
     * @param array array $array Insert datapool
     * @return boolean Returns if query finished in success
     * @createDate 04/16/2025
     * @lastmodifiedBy Daniel Liszi
     * @lastmodifiedDate 04/29/2025
     */
    public function Insert(array $array = []): bool
    {
        if (in_array("Insert", self::DB_ACT[$this->CLASS_ID])) {
            if (!isset($array["isDelete"])) {
                $array["isDelete"] = 1;
            }
            if (!empty($array) && Valid::vString($this->classQueries["Insert"])) {
                return self::qRun([
                    "query" => $this->classQueries["Insert"],
                    "vData" => $array,
                ])->rowCount() > 0;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    /**
     * Default DB Select call
     * @public
     * @author Daniel Liszi
     * @param array  array  $array Select datapool
     * @param string string $type Sets which select query to be run from Table defined queries
     * @return array  Reterns data query result
     * @createDate 04/16/2025
     * @lastmodifiedBy Daniel Liszi
     * @lastmodifiedDate 04/29/2025
     */
    public function Select(array $array = [], string $type = ""): array
    {
        if (in_array("Select", self::DB_ACT[$this->CLASS_ID])) {
            if (Valid::vString($this->classQueries["Select"][$type])) {
                if (
                    ($tempVar = self::qRun([
                        "query" => $this->classQueries["Select"][$type],
                        "vData" => $array,
                    ]))->rowCount() > 0
                ) {
                    return $tempVar->fetchAll();
                } else {
                    return [];
                }
            } else {
                return [];
            }
        } else {
            return false;
        }
    }

    /**
     * Default DB Upadate call
     * @public
     * @author Daniel Liszi
     * @param array  array  $array Update datapool
     * @param string string $type Sets which update query to be run from Table defined queries
     * @return boolean Returns if query finished in success
     * @createDate 04/16/2025
     * @lastmodifiedBy Daniel Liszi
     * @lastmodifiedDate 04/29/2025
     */
    public function Update(array $array = [], string $type = ""): bool
    {
        if (in_array("Update", self::DB_ACT[$this->CLASS_ID])) {
            if (empty($type) && Valid::vString($this->classQueries["Update"])) { // Ha nincs type megadva, pl Group
                return self::qRun([
                    "query" => $this->classQueries["Update"],
                    "vData" => $array,
                ])->rowCount() > 0;
            } elseif (!empty($array) && Valid::vString($this->classQueries["Update"][$type])) {
                return self::qRun([
                    "query" => $this->classQueries["Update"][$type],
                    "vData" => $array,
                ])->rowCount() > 0;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Default DB Delete call
     * @public
     * @author Daniel Liszi
     * @param array    array  $array Delete datapool
     * @param string   string $type Sets which delete query to be run from Table defined queries
     * @return boolean Returns if query finished in success
     * @createDate 04/16/2025
     * @lastmodifiedBy Daniel Liszi
     * @lastmodifiedDate 04/29/2025
     */
    public function Delete(array $array = [], string $type = ""): bool
    {
        if (in_array("Delete", self::DB_ACT[$this->CLASS_ID])) {
            if (!empty($array) && Valid::vString($this->classQueries["Delete"])) {
                return self::qRun([
                    "query" => $this->classQueries["Delete"],
                    "vData" => $array,
                ])->rowCount() > 0;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * DB Class Id public access
     * @public
     * @author Daniel Liszi
     * @return integer Returns DB Class Id value
     * @createDate 04/16/2025
     * @lastmodifiedBy Daniel Liszi
     * @lastmodifiedDate 04/29/2025
     */
    public function Class_Id(): int
    {
        return $this->CLASS_ID;
    }

    /**
     * Checks if DB Table is available
     * @public
     * @author Daniel Liszi
     * @return boolean Returns if query finished in success
     * @createDate 04/16/2025
     * @lastmodifiedBy Daniel Liszi
     * @lastmodifiedDate 04/29/2025
     */
    public function Check(): bool
    {
        return !self::qCheck($this->CLASS_ID);
    }
}

?>
