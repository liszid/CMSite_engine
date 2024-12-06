<?php
declare(strict_types = 1);
namespace Samples;
use Toolkit\ {
	Log, Check, Valid
};
use Load\Loader as Load;
class sSite_Template_00 {

	public function __construct(array $array)
	{
		echo self::Build($array);
	}
   /**
 * Returns the Navigation bar of the HTML
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    private static function Navbar(array $array): string
    {
	$bgColor = $GLOBALS['Site']['Style']['BGColor']['Navbar_Top'];
	$brandColor = $GLOBALS['Site']['Style']['BGColor']['Brand'];
        $textColor = $GLOBALS['Site']['Style']['Text']['Navbar'];
		return '
            <nav id="mainNavBar" class="navbar navbar-expand-lg bg-'.$bgColor.' text-'.$textColor.' navbar-'.$brandColor.' fixed-top shadow">
                <a class="navbar-brand" data-link="Home">'.$GLOBALS['Site']['Content']['Title'].'</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        '.self::Navbar_Items($array['navbarLeft']).'
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="naw-item">&nbsp;</li>
                        '.self::Navbar_Generate($array['navbarRight']).'
                    </ul>
                </div>
            </nav>';
    }
/**
 * Sets the left part of the Navigation Bar
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Navbar_Items(array $array): string
	{
		$returnString = '';
		if (! empty($array)) {
			foreach ($array as $i) {
				$returnString.= self::Navbar_Generate($i);
			}
		}
		return $returnString;
	}
/**
 * Used for displaying items at the navigation bar
 * 
 * @param $array array
 * 
 * @return string
 * 
 * @author Liszi Dániel
 */
    public static function Navbar_Generate(array $array = array()): string
    {
        $dataToggle = '';
        $dataItems = '';

        if ($array['dataToggle'] === true) {
            $dataToggle .= 'data-link="'.$array['dataLink'].'" data-toggle="modal" data-target="#modalBox"';
        } elseif ($array['dataToggle'] === 'dropdown') {
            $dataToggle .= 'href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
            $dataItems .='<div class="dropdown-menu" aria-labelledby="nav-'.$array['dataLink'].'">';

            foreach ($array['dataItems'] as $i) {
                $dataItems .= '<a class="dropdown-item" data-link="'.$array['dataLink'].'/'.$i.'">'.sTranslate::Prompt($array['dataLink'].'/'.$i).'</a>';
            }

            $dataItems .= '</div>';
        } else {
            $dataToggle .= 'data-link="'.$array['dataLink'].'"';
        }

        return '
            <li class="nav-item'.$array['liClass'].'">
                <a class="nav-link hideOnSmall'.$array['aClass'].' text-'.$GLOBALS['Site']['Style']['Text']['Link'].'" id="nav-'.$array['dataLink'].'" '.$dataToggle.'>
                    <i class="fa fa-fw fa-'.$array['faClass'].'"></i>
                    <span class="hideThis">'.$array['Desc'].'</span>
                </a>'.$dataItems .'
            </li>';
    }
/**
 * Builds the site
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	public static function Build(array $array): string
	{
		$bodyBgColor = $GLOBALS['Site']['Style']['BGColor']['Body'];
		$footerBgColor = $GLOBALS['Site']['Style']['BGColor']['Footer'];
		$footerTextColor = $GLOBALS['Site']['Style']['Text']['Footer'];
		return '
            <!DOCTYPE html>
            <html lang="en">
                '.$array['header'].'
                <body>
                    <div id="navbar" class="over-the-top">
                            '.self::Navbar($array).'
                    </div>
                    <div id="body" style="min-height:75vh; margin-bottom:5.5rem" class="mt-5 bg-'.$bodyBgColor.'"></div>
                    <div id="modalBox" class="modal fade" role="dialog">
                        <div class="modal-dialog modal-lg" id="modalDialog"></div>
                    </div>
                    <footer class="page-footer font-small bg-'.$footerBgColor.' mt-4 text-'.$footerTextColor.' fixed-bottom">
                        '.$array['footer'].'
                    </footer>
                    <resources>
                        '.Load::JS($GLOBALS['Static']['JS']['path']).'
                    </resources>
                </body>
            </html>';
	}
}
