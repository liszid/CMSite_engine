<?php

declare(strict_types=1);

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Samples\ {
    sCard
    ,sFrame
    ,sRedirect
};

use Page\Classes\sAdministrative;

if (
    isset($sessionUsr['userId'])
    && (int)$sessionUsr['canAdministrative'] > 0
) {
/** @var array $returnArray It stores the content to be displayed */
    $returnArray = array();
/** @var array $urlPaths Routing assistant variable*/
    $urlPaths = array(
        "Root"          => array("path" => "Administrative")
        ,"Users"         => array("path" => "Administrative/Users", "role" => "mngUsers")
        ,"Huntgroups"    => array("path" => "Administrative/Huntgroups", "role" => "mngHuntgroups")
        ,"Groups"        => array("path" => "Administrative/Groups", "role" => "mngGroups")
        ,"Tools"         => array("path" => "Administrative/Tools", "role" => "mngTools")
    );
/** @var array $nonModal Indicates which actions should be shown as is*/
    $nonModal = array(
        'Logs'
        ,'Knowledge_Type'
        ,'Company_Site_Type'
    );
/** @var array $printView Sets actions to get print view*/
    $printView = array();
/**
 * Post action handling and form prompt section
 */
    if (
        isset($_POST['y'])
        && isset($_POST['z'])
    ) {
        if(
            Valid::vString(Check::isPost('y'))
            && Valid::vString(Check::isPost('z'))
        ) {
            $returnArray['path'] = $urlPaths[Check::isPost('y')]['path'].'/'.Check::isPost('z');
            $returnArray['content'] = sAdministrative::Action($_POST);
        }
/**
 * Printable section
 */
        if (Valid::vString($returnArray['content'])) {
            if (in_array(Check::isPost('z'), $nonModal) && ! isset($_POST['zn'])) {
                echo sFrame::Page($returnArray);
            } else {
                if (in_array(Check::isPost('z'), $printView)) {
                    $returnArray['print'] = true;
                }
                echo sFrame::Modal($returnArray);
            }

        } else {
            echo sRedirect::Home();
        }
/**
 * Page loading section
 */
    } elseif (
        isset($_POST['y'])
        || isset($_POST['b'])
    ) {
        $postUrl = Check::isEither(array('post' => array('y', 'b'), 'fallBack' => 'Administrative'));
        $returnArray['path'] = $urlPaths[$postUrl]['path'];

        switch ($postUrl) {
            case 'Users':
                $returnArray['content'] = ((int)$sessionUsr[$urlPaths[$postUrl]['role']] > 0 ) ? sAdministrative::Users($returnArray) : '';
                break;
            case 'Groups':
                $returnArray['content'] = ((int)$sessionUsr[$urlPaths[$postUrl]['role']] > 0 ) ? sAdministrative::Groups($returnArray) : '';
                break;
            case 'Huntgroups':
                $returnArray['content'] = ((int)$sessionUsr[$urlPaths[$postUrl]['role']] > 0 ) ? sAdministrative::Huntgroups($returnArray) : '';
                break;
            case 'Tools':
                $returnArray['path'] .= (isset($_POST['c']))? '/'.$_POST['c'] : '';
                $returnArray['content'] = ((int)$sessionUsr[$urlPaths[$postUrl]['role']] > 0 ) ? sAdministrative::Tools($returnArray) : '';
                break;
        }

        echo (
            ( isset($returnArray['content']))
            ? sFrame::Page($returnArray)
            : sRedirect::Home()
        );
/**
 * Collective page with Cards
 */
    } else {
        $returnArray['path'] = $urlPaths['Root']['path'];
        $returnArray['content'] = '<div class="card-columns m-2">';

        foreach ($urlPaths as $key => $value) {
            if (strcmp(array_key_first($urlPaths), $key)) {
                if (
                    isset($value['role'])
                    && (int)$sessionUsr[$value['role']] > 0
                ) {
                    $returnArray['content'] .= sCard::Translated($value['path'], 'Linked');
                }
            }
        }

        $returnArray['content'] .= '</div>';

        echo sFrame::Page($returnArray);
    }
} else {
    echo sRedirect::Home();
}
