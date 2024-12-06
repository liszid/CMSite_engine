<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

$lang = 'hu';

abstract class abstractTranslate{
/**
 * Prompts respective name from array[type]
 *
 * @param $string string
 * @param $type string
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Prompt(string $string, string $type = 'navbar'): string
    {
        if (array_key_exists($string, static::TRANSLATE)) {
            return  static::TRANSLATE[$string][$type];
        } else {
            $explString = explode("/", $string);
            if (count($explString) === 3) {
                $explMain = $explString[0]."/".$explString[1];
                if (array_key_exists($explString[2], static::TRANSLATE[$explMain]['action'])) {
                    return static::TRANSLATE[$explMain]['action'][$explString[2]];
                }
            }
            return 'Ismeretlen kifejezés';
        }
    }

/**
 * Returns the info array of the key if exists
 *
 * @param $string string
 *
 * @return array
 *
 * @author Liszi Dániel
 */
    public static function Info(string $string): array
    {
        if (array_key_exists($string, static::TRANSLATE)) {
            if(isset(static::TRANSLATE[$string]['info'])) {
                $array = static::TRANSLATE[$string]['info'];
                $array['path'] = $string;
                return  $array;
    	    } else {
                return array();
    	    }
    	} else {
    	    return array();
    	}
    }

/**
 * Returns a HTML Title on set size
 *
 * @param $array array
 * @param $size int
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Title(string $string, int $size = 1): string
    {
            if (array_key_exists($string, static::TRANSLATE)) {
                return '<h'.$size.'><i class="fa fa-'.static::TRANSLATE[$string]['fa'].'" aria-hidden="true"></i> '.static::TRANSLATE[$string]['title'].'</h'.$size.'>';
            } else {
                $explString = explode("/", $string);
                if (count($explString) === 3) {
                    $explMain = $explString[0]."/".$explString[1];
                    if (array_key_exists($explString[2], static::TRANSLATE[$explMain]['action'])) {
                        return '<h'.$size.'><i class="fa fa-'.static::TRANSLATE[$explMain]['fa'].'" aria-hidden="true"></i> '.static::TRANSLATE[$explMain]['action'][$explString[2]].'</h'.$size.'>';
                    }
                }
                return '<h'.$size.'><i class="fa fa-question" aria-hidden="true"></i> Ismeretlen</h'.$size.'>';
            }
    }
    
}

if ($lang == 'en') {
     class sTranslate extends abstractTranslate implements
        sTranslate\en\ACTION,
        sTranslate\en\ROLE,
        sTranslate\en\ROLE_SELECT,
        sTranslate\en\TRANSLATE {}
} else if ($lang == 'hu') {
     class sTranslate extends abstractTranslate implements
        sTranslate\hu\ACTION,
        sTranslate\hu\ROLE,
        sTranslate\hu\ROLE_SELECT,
        sTranslate\hu\TRANSLATE {}
} else  {
     class sTranslate extends abstractTranslate implements
        sTranslate\en\ACTION,
        sTranslate\en\ROLE,
        sTranslate\en\ROLE_SELECT,
        sTranslate\en\TRANSLATE {}
}