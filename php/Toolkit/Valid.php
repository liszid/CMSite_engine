<?php

declare(strict_types=1);

namespace Toolkit;

class Valid
{

/**
 * Checks if string is useable
 *
 * @param $string string
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    public static function vString(string $string): bool
    {
        if (
            isset($string)
            && ! is_null($string)
            && ! empty(trim($string))
        ) {
            return true;
        } else {
            return false;
        }
    }

/**
 * Checks if array is useable
 *
 * @param $array array
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    public static function vArray(array $array): bool
    {
        if (
            isset($array)
            && is_array($array)
            && ! empty($array)
        ) {
            return true;
        } else {
            return false;
        }
    }

/**
 * Checks if input string is of regular expression
 *
 * @param $string string
 * @param $int int
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    public static function vInput(string $string, int $int): bool
    {
        if (self::vString($string) && $int < 4) {
            $regEx = array(
            //  Input
                0   => '/^[a-zA-Z0-9]*$/',
            //  Password
                1   => '/A(?=[-_a-zA-Z0-9]*?[A-Z])(?=[-_a-zA-Z0-9]*?[a-z])(?=[-_a-zA-Z0-9]*?[0-9])[-_a-zA-Z0-9]{6,}z/',
            //  Text
                2   => '/^[a-zA-Z0-9aáeéiíoóöőuúüűAÁEÉIÍOÓÖŐUÚÜŰ .,?!":=\-_()&#+\@/]*$/',
            //  Numeric
                3   => '/^[0-9]*$/'
            );
            return (preg_match($regEx[$int], $string) === 1);
        } elseif (self::vString($string) && $int === 4) {
            return self::vEmail($string);
        } else {
            return false;
        }
    }

/**
 * Checks if e-mail address is useable
 *
 * @param $string string
 *
 * @return bool
 *
 * @author Liszi Dániel
 */
    private static function vEmail(string $string): bool
    {
        $atIndex = strrpos($string, "@");

        if (is_bool($atIndex) && !$atIndex) {
           return false;
        } else {
            $domain = substr($string, $atIndex+1);
            $local = substr($string, 0, $atIndex);
            $localLen = strlen($local);
            $domainLen = strlen($domain);

            if (
                $localLen < 1
                || $localLen > 64
                || $domainLen < 1
                || $domainLen > 255
                || $local[0] == '.'
                || $local[$localLen-1] == '.'
                || preg_match('/\\.\\./', $local)
                || ! preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain)
                || preg_match('/\\.\\./', $domain)
            ) {
                return false;
            }

            if( !preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', str_replace("\\\\","",$local))) {
                if (!preg_match('/^"(\\\\"|[^"])+"$/',str_replace("\\\\","",$local))) {
                    return false;
                }
            }
/*
 *
 *            if (! (checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
 *                return false;
 *            }
 */
            return true;
        }
    }
}
