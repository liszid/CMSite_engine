<?php

declare(strict_types=1);

namespace Samples;

class sRoles
{
/**
 * Used to display Role settings at profile page
 * 
 * @param $array array
 * 
 * @return string
 * 
 * @author Liszi Dániel
 */
    public static function Prompt(array $array = array()): string
    {
        if (isset($array)) {
            $prompt = '';
/** @var array $elementArray Array of privileges used */
            $elementArray = array('canAdministrative','canUsers');
            return '
                <ul class="list-group">
                    <li class="list-group-item text-muted">
                        <i class="fa fa-dashboard"></i> Jogosultságok
                    </li>
                    '.$prompt.'
                </ul>';
        } else {
            return '';
        }

    }
}
