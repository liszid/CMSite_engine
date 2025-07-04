<?php

declare(strict_types=1);

namespace Toolkit;

class Check
{
    public static function isPost(string $string): string
    {
        return isset($_POST[$string]) ? $_POST[$string] : "";
    }

    public static function isGet(string $string): string
    {
        return isset($_GET[$string]) ? $_GET[$string] : "";
    }

    public static function isEither(array $array): string
    {
        if ((isset($array["post"]) || isset($array["get"])) && isset($array["fallBack"])) {
            if (!is_array($array["post"]) && !is_array($array["get"])) {
                if (isset($array["post"]) && ($returnString = self::isPost($array["post"])) !== "") {
                    return $returnString;
                } elseif (isset($array["get"]) && ($returnString = self::isGet($array["get"])) !== "") {
                    return $returnString;
                } else {
                    return $array["fallBack"];
                }
            } else {
                if (isset($array["post"])) {
                    if (is_array($array["post"])) {
                        foreach ($array["post"] as $i) {
                            if (($returnString = self::isPost($i)) !== "") {
                                return $returnString;
                            }
                        }
                    } else {
                        if (($returnString = self::isPost($array["post"])) !== "") {
                            return $returnString;
                        }
                    }
                }
                if (isset($array["get"])) {
                    if (is_array($array["get"])) {
                        foreach ($array["get"] as $i) {
                            if (($returnString = self::isPost($i)) !== "") {
                                return $returnString;
                            }
                        }
                    } else {
                        if (($returnString = self::isPost($array["get"])) !== "") {
                            return $returnString;
                        }
                    }
                }
                return $array["fallBack"];
            }
        } else {
            if (isset($array["fallBack"])) {
                return $array["fallBack"];
            } else {
                return "null";
            }
        }
    }

    public static function isDataSet(array $haystack, string $needle, string $true, string $false): string
    {
        $true = isset($true) && !empty($true) ? $true : $haystack[$needle];
        return isset($haystack[$needle]) ? (string) $true : (string) $false;
    }
}
?>
