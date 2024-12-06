<?php

declare(strict_types=1);

namespace Page\Classes;



interface iDevlog
{
/*
* Contains latest development notes
* @author Liszi Dániel
* @since 2024.03.14
*/
	const latestDeployment = '
        <div class="container p-3 my-3 bg-dark text-white lead font-weight-bold">Version Notice</div>
        <hr class="dashed">
        <strong>Version 2.01.04 - DEPLOYED</strong><br />
        <div style="padding-left: 1em;">
            <b>Updates</b>
             <ul>
                <li class="arrow">Rekeased old functionalities</li> 
            </ul>
        </div>
        ';
    
    const deploymentLogs = '
        <hr class="dashed">
        <strong>Version 2.01.03 - DEPLOYED</strong><br />
        <div style="padding-left: 1em;">
            <b>Updates</b>
             <ul>
                <li class="arrow"> Mobile UX/UI bug fix of narrowly displayed menus, pages</li> 
                <li class="arrow"> Set up mobile and desktop interfaces to have distinguished display</li> 
                <li class="arrow"> Cleaner display of items on the frontpage from calendar</li> 
            </ul>
        </div>';
}