<?php

declare(strict_types=1);

namespace Data;

use Toolkit\{Log, Check, Valid};

class Data
{
    /**
     * Checks if data key is available and valid
     * @param array source array with data call
     * @param array check array containing key value for checking data
     * @return boolean Returns if data available
     * @author Daniel Liszi
     * @createDate 11/04/2020
     * @lastmodifiedBy Daniel Liszi
     * @lastmodifiedDate 04/22/2025
     * @protected
     */
    protected static function CheckBool(array &$array, array $checkArray): bool
    {
        $checkBool = true;
        foreach ($checkArray as $i) {
            if (
                !isset($array[$i["key"]]) ||
                (!Valid::vInput($array[$i["key"]], $i["type"]) && Valid::vString($array[$i["key"]]))
            ) {
                $checkBool = false;
            } elseif (isset($array[$i["key"]]) && !Valid::vString($array[$i["key"]])) {
                switch ($i["type"]) {
                    case 2:
                        $array[$i["key"]] = "-";
                        break;
                    case 3:
                        $array[$i["key"]] = "1";
                        break;
                }
            }
        }
        return $checkBool;
    }
}
?>
