<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class sBreadcrumbs {
/**
 * Generates breadcrumb bar
 *
 * @param $string string
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Prompt(string $string): string
    {
	$explode = explode('/', $string);
	$arrLength = count($explode);
	$arrIter = 0;
	$arrString = '';

	$returnString = '
        <div class="col-12">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">'.
                ((strcmp($string, 'Home'))
                    ? '<li class="breadcrumb-item"><a data-link="Home">'.sTranslate::Prompt('Home').'</a></li>'
                    : ''
                );

	foreach($explode as $i) {
	    if(++$arrIter === $arrLength) {
            $returnString .= '<li class="breadcrumb-item active"><a data-link="'.$arrString.$i.'">'.sTranslate::Prompt($arrString.$i).'</a></li>';
	    } else {
            $returnString .= '<li class="breadcrumb-item"><a data-link="'.$arrString.$i.'">'.sTranslate::Prompt($arrString.$i).'</a></li>';
	    }

	    $arrString .= $i.'/';
	}

	$returnString .= '</ol></nav></div>';

	return $returnString;
    }
}
