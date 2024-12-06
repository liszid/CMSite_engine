<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class sRedirect
{
/**
 * Alias function, which redirects to the Home page
 *
 * @return string
 *
 * @author Liszi Dániel
 *
 * @uses self::Error()
 */
    public static function Home(): string
    {
        return self::Error(array( 'icon' => 'exclamation-triangle', 'title' => 'Hiba', 'desc' => 'Érvénytelen próbálkozás', 'script' => "Instance.initElmnt('x=Home'); $('[data-dismiss=modal]').trigger({ type: 'click' });"));
    }

/**
 * Modal frame display
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Modal(array $array = array()): string
    {
        return '
            <modalmessage>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa '.$array['icon'].'"></i> '.$array['title'].'</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center justification-centered">
                    <h4>'.$array['desc'].'</h4>
                    <div class="spinner-grow">
                        <img style="display:none;" src="'.$GLOBALS['Root']['Path'].'images/placeholder.png" alt="Loading Animation" onload="setTimeout(function(){ '. ( isset( $array['script'] ) ? $array['script'] : 'window.location.reload()' ) .'}, 750);">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            </modalmessage>';
    }

/**
 * Similar to self::Modal, with different colours
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Error(array $array = array()): string
    {
        return '
            <errormessage>
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title text-white"><i class="fa '.$array['icon'].'"></i> '.$array['title'].'</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center text-white justification-centered">
                    <h4>'.$array['desc'].'</h4>
                    <div class="spinner-grow">
                        <img style="display:none;" src="'.$GLOBALS['Root']['Path'].'images/placeholder.png" alt="Loading Animation" onload="setTimeout(function(){ '. ( isset( $array['script'] ) ? $array['script'] : 'window.location.reload()' ) .'}, 750);">
                    </div>
                </div>
            </div>
            </errormessage>';
    }
/**
 * Used only at Profile Editing and Login action
 *
 * @param $array array
 * @param $type string
 *
 * @return string
 *
 * @author Liszi Dániel
 *
 * @deprecated
 */
    public static function Sample(array $array = array()): string
    {
        $redirectArray = array(
            'icon' => $array['redirect']['icon'],
            'title' => $array['redirect']['title']
        );
        if ($array['bool']) {
            if (isset($array['update']) && $array['update']) {
                $dUser = new dUser;
                $dUser::Reload($array['id']);
            } elseif (isset($array['login']) && $array['login']) {
                sActivity::Set(intval($array['id']));
            }
            if (isset($array['redirect']['success'])) {
                $redirectArray['script'] = $array['redirect']['success'];
            }
            $redirectArray['desc'] = 'Sikeres '.$array['redirect']['desc'];
        } else {
            if (isset($array['redirect']['fail'])) {
                $redirectArray['script'] = $array['redirect']['fail'];
            }
            $redirectArray['desc'] = 'Sikertelen '.$array['redirect']['desc'];
        }
        return sRedirect::Modal($redirectArray);
    }
}
