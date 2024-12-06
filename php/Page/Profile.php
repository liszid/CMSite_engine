<?php

declare(strict_types=1);

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Data\
{
    dUser
    ,dCombined
};

use Samples\
{
    sRoles
    ,sFrame
    ,sForm
    ,sProfile
    ,sRedirect
    ,sActivity
    ,sTranslate
};

if (isset($sessionUsr['userId'])) {
/** @var object $dUser Initializes User class handler */
    $dUser = new dUser();
/** @var object $dCombined Initializes User class handler */
    $dCombined = new dCombined();
/** @var array $urlPaths Routing assistant */
    $urlPaths = array(
        'Root' => 'Profile'
    );

    if(isset($_POST["Save"]) && (int)$sessionUsr['canEdit'] > 0) {
        $returnText = sTranslate::ACTION['Fail']['content'];

        if ($dUser::Update($_POST, Check::isPost('y'))) {
            sActivity::Set(($dCombined->Select($sessionUsr,'User_Full'))[0]);
            $returnText = sTranslate::ACTION['Success']['content'];
        }

        $returnContent = '
                <div class="text-center justification-centered">
                    <h4>'.$returnText.'</h4>
                    '.sForm::Spinner(array('x' => 'Profile', 'reload' => true)).'
                </div>';

        echo sFrame::Modal(array('path' => 'Profile', 'content' => $returnContent));

    } elseif (isset($_POST['x']) && ! strcmp($_POST['x'], 'Profile')) {
        $User = ($dCombined->Select($sessionUsr, 'User_Full'))[0];
        $User['Huntgroups'] = ($dCombined->Select($sessionUsr, 'User_Huntgroups'));

        $modalText = '';

        if (isset($_POST['dp'])) {
            $modalText = sProfile::Prompt($User, $_POST['dp']);
        } else {
            $modalText = sProfile::Prompt($User,'Self');
        }

        $modalBody = '
            <div class="container bootstrap snippet">
                <div class="row">
                    <div class="col-md-8">
                        '.$modalText.'
                    </div>
                    <div class="col-md-4">
                        '.(sActivity::Prompt($sessionAct)).'
                        <br />
                        '.(sRoles::Prompt($sessionUsr)).'
                    </div>
                </div>
            </div>';
        echo sFrame::Modal(array('path' => $urlPaths['Root'], 'content' => $modalBody));
    } else {
        echo sRedirect::Home();
    }
}
else
{
    echo sRedirect::Home();
}
