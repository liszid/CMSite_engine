<?php

declare(strict_types=1);

namespace Data;

use Database\dbAccess;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Samples\sActivity;

class dAccess implements iData
{
    private static $dbAccess;

/**
 * Encodes a string into mathematical form
 *
 * @param $string string
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    private static function Encode(string $string = ""): string
    {
        $input = str_split($string);
        $tempArr = array('Start' => '', 'End' => '');
        foreach($input as $i){
            $temp = dechex(ord($i));
            $tempArr['Start'] .= $temp[0];
            $tempArr['End'] .= $temp[1];
        }
        return $tempArr['Start'].$tempArr['End'];
    }

/**
 * Decodes encoded string
 *
 * @param $string string
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Decode(string $string = ""): string
    {
        $input = str_split($string);
        $tempArr = '';
        $half = count($input) / 2;

        for($i = 0; $i < $half; $i++) {
            $tempArr .= chr(hexdec($input[$i].$input[$i + $half]));
        }

        return $tempArr;
    }

    public function __construct()
    {
        self::$dbAccess = new dbAccess();
    }

    public static function Insert(array $array = array()): bool
    {
        $array['accessPassword'] = self::Encode($array['accessPassword']);

        $returnData = self::$dbAccess->Insert($array);

        $dCombined = new dCombined();
        sActivity::Set(($dCombined->Select($array,'User_Full'))[0]);

        return $returnData;
    }

    public static function Select(array $array = array(), string $type = ''): array
    {
        return self::$dbAccess->Select($array, $type);
    }

    public static function Update(array $array = array(), string $type = ''): bool
    {
        $array['accessPassword'] = self::Encode($array['accessPassword']);

        return self::$dbAccess->Update($array, $type);
    }

    public static function Delete(array $array = array(), string $type = ''): bool
    {
        return self::$dbAccess->Delete($array, $type);
    }

    public static function Class_Id(): int
    {
        return self::$dbAccess->Class_Id();
    }

    public static function Check( ): bool
    {
        return (self::$dbAccess->Check());
    }
}
