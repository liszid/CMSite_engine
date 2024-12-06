<?php
declare(strict_types = 1);
namespace Samples;

use Toolkit\ {
	Log, Check, Valid
};

use Load\Loader as Load;

class sSite_Template_01 {

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
	private static function Navbar_Side(array $array): string
	{
		if (! empty($array)) {
			$bgColor = $GLOBALS['Site']['Style']['BGColor']['Navbar_Side'];
			$textColor = $GLOBALS['Site']['Style']['Text']['Navbar'];

			return '
			<div class="p-0 m-0 coverIt">
				<nav id="collapsibleNavbar" class="sidebar position-sm-fixed collapse h-100 d-md-block bg-'.$bgColor.' text-'.$textColor.' over-the-top">
					<div class="sticky-md-top pt-md-5 mx-2">
						<ul class="nav flex-column mt-3">
							' . self::Navbar_Items($array) . '
						</ul>
					</div>
				</nav>
			</div>';
		} else {
			return '';
		}		
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
 * Sets the right side of the Navigation Bar
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Navbar_Top(array $array): string
	{
		$brandColor = $GLOBALS['Site']['Style']['BGColor']['Brand'];
		$bgColor = $GLOBALS['Site']['Style']['BGColor']['Navbar_Top'];
		$textColor = $GLOBALS['Site']['Style']['Text']['Navbar'];
		$navLinkColor = $GLOBALS['Site']['Style']['Text']['Navbar'];

		return '
			<nav id="mainNavBar" class="over-the-top position-md-fixed sticky-top navbar navbar-expand-lg navbar-'.$brandColor.' p-1 shadow w-100 bg-'.$bgColor.' text-'.$textColor.'">
				<a class="navbar-brand mr-0 px-3 text-'.$navLinkColor.'" data-link="Home">' . $GLOBALS['Site']['Content']['Title'] . '</a>
				<ul class="navbar-nav ml-auto mr-2">
					' . self::Navbar_Generate($array['navbarRight']) . '
				</ul>'. ((!empty($array['navbarLeft']))
			   ?'<button class="d-flex flex-row navbar-toggler d-md-none collapsed" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>':'').'
			</nav>
			';
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
            <li class="nav-item'.$array['liClass'].' border-right border-left rounded-pill m-1 border-gray-40">
                <a class="nav-link'.$array['aClass'].'" id="nav-'.$array['dataLink'].'" '.$dataToggle.'>
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
				' . $array['header'] . '
				<body>
					' . self::Navbar_Top($array) . '
					<div class="container-fluid p-0 m-0 bg-'.$bodyBgColor.'">
			    		<div class="d-flex flex-column flex-sm-row flex-nowrap h-100">
			    			'. ((!empty($array['navbarLeft']))
			    			?self::Navbar_Side($array['navbarLeft']).'
			    			<main role="main" class="p-0 m-0 w-100 d-flex flex-column flex-nowrap">':'<main role="main" class="m-0 p-0 w-100">').'
									<div id="body" class="my-md-5 position-relative" style="min-height:90vh">
									</div>
									<div id="modalBox" class="modal fade" role="dialog">
										<div class="modal-dialog modal-lg" id="modalDialog">
										</div>
									</div>
									<footer class="page-footer fixed-bottom font-small bg-'.$footerBgColor.' text-'.$footerTextColor.' ">
										' . $array['footer'] . '
									</footer>
									<resources>
										' . Load::JS($GLOBALS['Static']['JS']['path']) . '
									</resources>
							</main>
						</div>
					</div>
				</body>
			</html>';		
	}
}
					