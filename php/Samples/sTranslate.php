<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{Log, Check, Valid};

$lang = 'hu';

/**
 * @update 2024.12.11
 * @author Liszi Dániel
 */
abstract class AbstractTranslate
{
    /**
     * Prompts respective name from array[type]
     *
     * @param string $string
     * @param string $type
     * @return string
     */
    public static function Prompt(string $string, string $type = 'navbar'): string
    {
        if (isset(static::TRANSLATE[$string][$type])) {
            return static::TRANSLATE[$string][$type];
        }

        $explString = explode('/', $string);
        if (count($explString) === 3) {
            $explMain = $explString[0] . '/' . $explString[1];
            if (isset(static::TRANSLATE[$explMain]['action'][$explString[2]])) {
                return static::TRANSLATE[$explMain]['action'][$explString[2]];
            }
        }

        return 'Ismeretlen kifejezés';
    }

    /**
     * Returns the info array of the key if exists
     *
     * @param string $string
     * @return array
     */
    public static function Info(string $string): array
    {
        if (isset(static::TRANSLATE[$string]['info'])) {
            return ['path' => $string] + static::TRANSLATE[$string]['info'];
        }

        return [];
    }

    /**
     * Returns a HTML Title on set size
     *
     * @param string $string
     * @param int $size
     * @return string
     */
    public static function Title(string $string, int $size = 1): string
    {
        if (isset(static::TRANSLATE[$string])) {
            return sprintf('<h%d><i class="fa fa-%s" aria-hidden="true"></i> %s</h%d>', $size, static::TRANSLATE[$string]['fa'], static::TRANSLATE[$string]['title'], $size);
        }

        $explString = explode('/', $string);
        if (count($explString) === 3) {
            $explMain = $explString[0] . '/' . $explString[1];
            if (isset(static::TRANSLATE[$explMain]['action'][$explString[2]])) {
                return sprintf('<h%d><i class="fa fa-%s" aria-hidden="true"></i> %s</h%d>', $size, static::TRANSLATE[$explMain]['fa'], static::TRANSLATE[$explMain]['action'][$explString[2]], $size);
            }
        }

        return sprintf('<h%d><i class="fa fa-question" aria-hidden="true"></i> Ismeretlen</h%d>', $size, $size);
    }
}

switch($lang) {
    case 'hu':
        class sTranslate extends AbstractTranslate implements 
            sTranslate\hu\ACTION, 
            sTranslate\hu\ROLE, 
            sTranslate\hu\ROLE_SELECT, 
            sTranslate\hu\TRANSLATE 
        {
        }
        break;
    case 'en':
        class sTranslate extends AbstractTranslate implements 
            sTranslate\en\ACTION, 
            sTranslate\en\ROLE, 
            sTranslate\en\ROLE_SELECT, 
            sTranslate\en\TRANSLATE 
        {
        }
        break;
}
?>