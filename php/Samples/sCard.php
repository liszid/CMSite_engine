<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class sCard
{
/**
 * Returns the set type of Card using sTranslate
 *
 * @param $string string
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Translated(string $string = '', string $type = ''): string
    {
        switch ($type) {
            case 'Card':
                return self::Card($string);
                break;
            case  'Linked':
                return self::Linked($string);
                break;
        }
    }

/**
 * Returns Card array for the corresponding Role
 *
 * @param $string string
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    private static function Card(string $string): string
    {
	    if (array_key_exists($string, sTranslate::ROLE)) {
	        if (array_key_exists(sTranslate::ROLE[$string]['respective'], sTranslate::TRANSLATE)) {
	        		 $cardColor = (!isset($GLOBALS['Site']['Style']['BGColor']['Card']))?sTranslate::ROLE[$string]['color']:$GLOBALS['Site']['Style']['BGColor']['Card'];
                return self::Blank(
                    array(
                        'color' => $cardColor//sTranslate::ROLE[$string]['color']
                        , 'header' => sTranslate::TRANSLATE[sTranslate::ROLE[$string]['respective']]['title']
                        ,'text' => sTranslate::TRANSLATE[sTranslate::ROLE[$string]['respective']]['card']
                        /*,'header' => sTranslate::ROLE[$string]['header']
                        ,'title' => sTranslate::TRANSLATE[sTranslate::ROLE[$string]['respective']]['title']
                        ,'text' => sTranslate::TRANSLATE[sTranslate::ROLE[$string]['respective']]['card']*/
                    )
                );
	        } else {
		        return '';
	        }
        } elseif  (array_key_exists($string, sTranslate::TRANSLATE)) {
            $key = array_keys(sTranslate::ROLE)[array_search($string, array_column(sTranslate::ROLE, 'respective'))];
            if ($key !== false) {
            	 $cardColor = (!isset($GLOBALS['Site']['Style']['BGColor']['Card']))?sTranslate::ROLE[$key]['color']:$GLOBALS['Site']['Style']['BGColor']['Card'];
                return self::Blank(
                    array(
                        'color' => $cardColor//sTranslate::ROLE[$key]['color']
                        ,'header' => sTranslate::TRANSLATE[$string]['title']
                        ,'text' => sTranslate::TRANSLATE[$string]['card']
                        /*,'header' => sTranslate::ROLE[$key]['header']
                        ,'title' => sTranslate::TRANSLATE[$string]['title']
                        ,'text' => sTranslate::TRANSLATE[$string]['card']*/
                    )
                );
            } else {
                return '';
            }
	    } else {
	        return '';
	    }
    }

/**
 * Returns a Blank Card with a Link to its respective menu
 *
 * @param $string string
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    private static function Linked(string $string): string
    {
	    if (array_key_exists($string, sTranslate::ROLE)) {
	        if (array_key_exists(sTranslate::ROLE[$string]['respective'], sTranslate::TRANSLATE)) {
                return '<a data-link="'.sTranslate::ROLE[$string]['respective'].'">'.self::Card($string).'</a>'; //class="ml-auto"
	        } else {
		        return '';
	        }
        } elseif (array_key_exists($string, sTranslate::TRANSLATE)) {
            return '<a data-link="'.$string.'">'.self::Card($string).'</a>'; // class="m-2"
	    } else {
	        return '';
	    }
    }

/**
 * Used to display Blank card
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Blank(array $array = array()): string
    {
        $cardColor = (!isset($GLOBALS['Site']['Style']['BGColor']['Card']))?$array['color']:$GLOBALS['Site']['Style']['BGColor']['Card'];
        $cardContentColor = (!isset($GLOBALS['Site']['Style']['Text']['Card']['Content']))?'white':$GLOBALS['Site']['Style']['Text']['Card']['Content'];
        $cardHeaderColor = (!isset($GLOBALS['Site']['Style']['Text']['Card']['Header']))?'white':$GLOBALS['Site']['Style']['Text']['Card']['Header'];

        $cardHeader = ((isset($array['header']) && Valid::vString($array['header']))?'<div class="card-header bg-'.$cardColor.' text-'.$cardHeaderColor.' border-'.$cardHeaderColor.'">'.$array['header'].'</div>':'');
        $cardTitle = ((isset($array['title']) && Valid::vString($array['title']))?'<h5 class="card-title">'.$array['title'].'</h5>':'');
        $cardText = ((isset($array['text']) && Valid::vString($array['text']))?'<p class="card-text">'.$array['text'].'</p>':'');
        $cardButton = ((isset($array['button']) && Valid::vString($array['button']))?'<center>'.$array['button'].'</center>':'');

        return '
            <div class="card border-'.$cardContentColor.''.((isset($array['class']))?' '.$array['class']:'').'" '.((isset($array['bool']))?'style="max-width: 18rem;"': '').'>
                '.$cardHeader.'
                <div class="card-body text-'.$cardContentColor.'">
                '.$cardTitle.'
                '.$cardText.'
                '.$cardButton.'
                </div>
            </div>
        ';
    }

/**
 * Used to display Colorized card
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Fill(array $array = array()): string
    {
        $cardColor = (!isset($GLOBALS['Site']['Style']['BGColor']['Card']))?$array['color']:$GLOBALS['Site']['Style']['BGColor']['Card'];
        $cardContentColor = (!isset($GLOBALS['Site']['Style']['Text']['Card']['Header']))?'white':$GLOBALS['Site']['Style']['Text']['Card']['Header'];
        $cardHeaderColor = (!isset($GLOBALS['Site']['Style']['Text']['Card']['Header']))?'white':$GLOBALS['Site']['Style']['Text']['Card']['Header'];

        $cardHeader = ((isset($array['header']) && Valid::vString($array['header']))?'<div class="card-header text-'.$cardHeaderColor.'">'.$array['header'].'</div>':'');
        $cardTitle = ((isset($array['title']) && Valid::vString($array['title']))?'<h5 class="card-title">'.$array['title'].'</h5>':'');
        $cardText = ((isset($array['text']) && Valid::vString($array['text']))?'<p class="card-text">'.$array['text'].'</p>':'');
        $cardButton = ((isset($array['button']) && Valid::vString($array['button']))?$array['button']:'');

        return '
            <div class="card text-'.$cardHeaderColor.' bg-'.$cardColor.' m-2" '.((isset($array['bool']))?'style="max-width: 18rem;"': '').'>
                '.$cardHeader.'
                <div class="card-body text-'.$cardContentColor.'">
                '.$cardTitle.'
                '.$cardText.'
                '.$cardButton.'
                </div>
            </div>
        ';
    }

/**
 * Used to display a Collapsible section
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Collapsible(array $array = array()): string
    {
        $accordionId = 'accordion-'.md5('accordion-'.rand());
        $headingId = 'heading-'.md5('heading-'.rand());
        $collapseId = 'collapse-'.md5('collapse-'.rand());
        $contHeader = ((isset($array['header'])) ? $array['header'] : '');
        $contText = ((isset($array['content'])) ? $array['content'] : '');
        $contAddButton = ((isset($array['path']) && isset($array['addButton']) && $array['addButton'])? sForm::Add(array('path' => $array['path'], 'addNonModal' => $array['addNonModal'],'fa' => 'plus-circle')) : '');

        if (Valid::vArray($array)) {
            return '
                <div id="'.$accordionId.'" class="mb-2 col-12">
                    <div class="card">
                        <div class="d-flex flew-nowrap flex-column flex-sm-row m-1" id="'.$headingId.'">
                            <h5 class="mb-0 col-12 col-sm">
                                <button class="d-flex justify-content-sm-start justify-content-center col-12 btn btn-link collapsed" data-toggle="collapse" data-target="#'.$collapseId.'" aria-expanded="false" aria-controls="'.$collapseId.'">
                                '.$contHeader.'
                                </button>
                            </h5>
                            '.$contAddButton.'
                        </div>
                        <div id="'.$collapseId.'" class="collapse" aria-labelledby="'.$headingId.'" data-parent="#'.$accordionId.'">
                            <div class="card-body" style="color:'.$GLOBALS['Site']['Style']['Text']['Card']['Content'].'">
                                '.$contText.'
                            </div>
                        </div>
                    </div>
                </div>
            ';
        } else {
            return '';
        }
    }
}
