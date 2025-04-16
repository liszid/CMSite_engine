<?php

declare(strict_types=1);

namespace Database;

use Toolkit\{Log, Check, Valid};

class Routing extends Table
{
    public $CLASS_ID;

    private $classQueries = [];

    const DB_ACT = [
        0 => ["Insert", "Select", "Update", "Delete"], //User
        1 => ["Insert", "Select", "Update", "Delete"], //Group == Authorities
        2 => ["Insert", "Select", "Update", "Delete"], //Group Member
        99 => ["Select"], //Combined
    ];

    public function __construct(int $id)
    {
        parent::__construct();
        $this->CLASS_ID = $id;
        $this->classQueries = self::qGet($this->CLASS_ID);
    }

    public function Insert(array $array = []): bool
    {
        if (in_array("Insert", self::DB_ACT[$this->CLASS_ID])) {
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

    public function Class_Id(): int
    {
        return $this->CLASS_ID;
    }

    public function Check(): bool
    {
        return !self::qCheck($this->CLASS_ID);
    }
}

?>
