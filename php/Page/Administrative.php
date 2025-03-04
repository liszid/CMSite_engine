<?php

declare(strict_types=1);

use Toolkit\{Log, Check, Valid};
use Samples\{sCard, sFrame, sRedirect};
use Page\Classes\sAdministrative;

if (isset($sessionUsr['userId']) && (int)$sessionUsr['canAdministrative'] > 0) {
    $returnArray = [];
    $urlPaths = [
        "Root" => ["path" => "Administrative"],
        "Users" => ["path" => "Administrative/Users", "role" => "mngUsers"],
        "Huntgroups" => ["path" => "Administrative/Huntgroups", "role" => "mngHuntgroups"],
        "Groups" => ["path" => "Administrative/Groups", "role" => "mngGroups"],
    ];
    $nonModal = ['Logs'];
    $printView = [];

    if (isset($_POST['y'], $_POST['z']) && Valid::vString(Check::isPost('y')) && Valid::vString(Check::isPost('z'))) {
        $returnArray['path'] = $urlPaths[Check::isPost('y')]['path'] . '/' . Check::isPost('z');
        $returnArray['content'] = sAdministrative::Action($_POST);

        if (Valid::vString($returnArray['content'])) {
            if (in_array(Check::isPost('z'), $nonModal) && !isset($_POST['zn'])) {
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
    } elseif (isset($_POST['y']) || isset($_POST['b'])) {
        $postUrl = Check::isEither(['post' => ['y', 'b'], 'fallBack' => 'Administrative']);
        $returnArray['path'] = $urlPaths[$postUrl]['path'];

        $content = match ($postUrl) {
            'Users' => ((int)$sessionUsr[$urlPaths[$postUrl]['role']] > 0) ? sAdministrative::Users($returnArray) : '',
            'Groups' => ((int)$sessionUsr[$urlPaths[$postUrl]['role']] > 0) ? sAdministrative::Groups($returnArray) : '',
            'Huntgroups' => ((int)$sessionUsr[$urlPaths[$postUrl]['role']] > 0) ? sAdministrative::Huntgroups($returnArray) : '',
            default => '',
        };

        $returnArray['content'] = $content;
        echo isset($returnArray['content']) ? sFrame::Page($returnArray) : sRedirect::Home();
    } else {
        $returnArray['path'] = $urlPaths['Root']['path'];
        $returnArray['content'] = '<div class="row1-container m-2">';
        
        foreach ($urlPaths as $key => $value) {
            if (strcmp(array_key_first($urlPaths), $key) && isset($value['role']) && (int)$sessionUsr[$value['role']] > 0) {
                $returnArray['content'] .= sCard::Translated($value['path'], 'Linked');
            }
        }

        $returnArray['content'] .= '</div>';
        echo sFrame::Page($returnArray);
    }
} else {
    echo sRedirect::Home();
}
