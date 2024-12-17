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
    sCard
    ,sFrame
    ,sForm
    ,sProfile
    ,sRedirect
    ,sTranslate
};

$returnContent = '';

if (! isset($sessionUsr['userId']) ) {
    $returnContent .= sCard::Fill(array('color' => 'cyan', 'header' => 'Welcome message', 'title' => 'Dear guest,', 'text' => 'For the usage of '.$GLOBALS['Site']['Content']['Title'].' website, you must login.'));
    
    $returnContent .=  '<div class="container p-3 my-3 bg-light text-dark"></div><br />';
} else {
/** @var object $dCombined Initializes User class handler */
    $dCombined = new dCombined();
    $User = ($dCombined->Select($sessionUsr, 'User_Full'))[0];
    $User['Huntgroups'] = ($dCombined->Select($sessionUsr, 'User_Huntgroups'));
    $modalText = sProfile::Prompt($User, 'Other');
   
    $returnContent .= '
        <div class="container bootstrap snippet" style="color:black">
                <div class="row">
                    <div class="col-md-12">
                        '.$modalText.'
                        <div class=" bg-light">
                            <div class="container p-3 my-3 bg-light"></div><br />
                        </div>
                    </div>
                    <div class="row"><div class="col-12" style="color:transparent; height:40vh;">0</div></div>
                </div>
            </div>';
}

echo sFrame::Page(array('path' => 'Home', 'content' => $returnContent));
