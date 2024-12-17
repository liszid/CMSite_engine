<?php

declare(strict_types=1);

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Samples\{
    sCard
    ,sFrame
    ,sRedirect
};

use Page\Classes\sCapacity;


if (
    isset($sessionUsr['userId'])
    && (int)$sessionUsr['canLogin'] > 0
) {
/** @var array $returnArray It stores the content to be displayed */
    $returnArray = array();
/** @var array $urlPaths Routing assistant variable*/
    $urlPaths = array(
        "Root"              => array("path" => "Capacity",             "role" => "canLogin")
        ,"Capacity"         => array("path" => "Capacity/Capacity",    "role" => "canLogin")
    );
/** @var array $nonModal Indicates which actions should be shown as is*/
    $nonModal = array(
        'Filter'
    );
/** @var array $printView Sets actions to get print view*/
    $printView = array(
        'View'
    );
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
            $returnArray['content'] = sInformations::Action($_POST);
        }
/**
 * Printable section
 */
        if (Valid::vString($returnArray['content'])) {
            if (in_array(Check::isPost('z'), $nonModal)) {
                echo $returnArray['content'];
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
        $postUrl = Check::isEither(array('post' => array('y', 'b'), 'fallBack' => 'Knowledge'));
        $returnArray['path'] = $urlPaths[$postUrl]['path'];

        $returnArray['content'] = ((int)$sessionUsr[$urlPaths[$postUrl]['role']] > 0 ) ? sInformations::ClassPage($returnArray) : '';
        
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
