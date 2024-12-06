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
    ,sCard
    ,sFrame
    ,sForm
    ,sProfile
    ,sRedirect
    ,sActivity
    ,sTranslate
};

use Page\Classes\cDevlog;

$returnContent = '';

$news = '
    <div class="jumbotron m-0 p-0 bg-light">
        '.cDevlog::latestDeployment.'
        </div>';

if (! isset($sessionUsr['userId']) ) {
    $returnContent .= sCard::Fill(array('color' => 'cyan', 'header' => 'Welcome message', 'title' => 'Dear guest,', 'text' => 'For the usage of '.$GLOBALS['Site']['Content']['Title'].' website, you must login.'));
    
    $returnContent .=  '<div class="container p-3 my-3 bg-light text-dark">'.$news.'</div><br />';
} else {
/** @var object $dCombined Initializes User class handler */
    $dCombined = new dCombined();
    $sActivity = new sActivity();
    $Activity = $sActivity::PieChart((int)$sessionUsr['userId']);
    $Calendar = $sActivity::CalendarEvents((int)$sessionUsr['userId']);
    $User = ($dCombined->Select($sessionUsr, 'User_Full'))[0];
    $User['Huntgroups'] = ($dCombined->Select($sessionUsr, 'User_Huntgroups'));
    $modalText = sProfile::Prompt($User, 'Other');
   
    $returnContent .= '
        <div class="container bootstrap snippet" style="color:black">
                <div class="row">
                    <div class="col-md-9">
                        '.$modalText.'
                        <div class=" bg-light">
                            <div class="container p-3 my-3 bg-light">'.cDevlog::Latest().'</div><br />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="container p-3 my-3 bg-dark text-white lead font-weight-bold"><i class="fa fa-calendar"></i> '.sTranslate::TRANSLATE['Calendar']['navbar'].'</div>
                        <div>'.$Calendar.'</div>
                        <div class="container p-3 my-3 bg-dark text-white lead font-weight-bold"><i class="fa fa-dashboard"></i> Tevékenység</div>
                        '.(sActivity::Prompt($sessionAct)).'
                        <div id="chartContainer">'.json_encode($Activity).'</div>
                    </div>
                    <div class="row"><div class="col-12" style="color:transparent; height:40vh;">0</div></div>
                </div>
            </div>';
}

echo sFrame::Page(array('path' => 'Home', 'content' => $returnContent));
