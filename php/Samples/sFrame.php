<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class sFrame {
/**
 * Default Modal display function used on Pages
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Modal(array $array = array()): string
    {
        if (! empty($array)) {
            return '
                <div class="modal-content">
                    <div class="modal-header">
                        '.((isset($array['print']) && $array['print'])?'<button class="btn btn-sm btn-warning mr-2" onclick="Instance.printElement(document.getElementById(\'printThis\'))"><i class="fa fa-print" aria-hidden="true"></i></button> ': '').'
                        '.sTranslate::Title($array['path'], 5).'
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                    '.$array['content'].'
                    </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Bezár</button>
                    </div>
                </div>';
        } else {
    	    return '';
        }
    }

/**
 * Default Page display function
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Page(array $array = array()): string
    {
        if (! empty($array)) {
            $explode = explode("/", $array['path']);
            $Origin = (count($explode) > 1)? $explode[count($explode) - 1] : $array['path'];
            $bgColor = $GLOBALS['Site']['Style']['Site']['titleBgColor'];
            $bgColor = $GLOBALS['Site']['Style']['BGColor'][$bgColor];
            $textColor = $GLOBALS['Site']['Style']['Text']['Body'];
            $headerTextColor = $GLOBALS['Site']['Style']['Text']['Header'];
//position-fixed over-the-top-m-1
            $returnString = '
                <div class="container-fluid col-12 bg-'.$bgColor.' pt-3">'.''
/*
                    <div class="text-'.$headerTextColor.' pl-5 py-2">
                        '.sTranslate::Title($array['path']).'
                    </div>
*/
                .'</div>
                <div class="mx-md-3 row pt-1 justify-content-center">
                    <div class="d-none d-md-block col-11 pt-2">
                        '.sBreadcrumbs::Prompt($array['path']).'
                    </div>
                    <div class="console-log col-sm-12 mx-4 col-md-9 mr-md-0 ml-md-0">
                        <div class="log-content">
                            <br />
                            <div class="col-12 mb-4 pb-4 text-'.$textColor.'">
                            '.$array['content'].'
                            </div>
                        </div>
                    </div>
                </div>';

            return $returnString;
        } else {
            return '';
        }
    }
}
