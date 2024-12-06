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
                <li class="arrow"> Priority given to the Knowledge Base, now positioned as the first item on the list.</li>
                <li class="arrow"> Planner section added, with contents of Calendar, Kanban and Grocery list</li> 
                <li class="arrow"> Grocery List page added, content in deployment</li> 
                <li class="arrow"> Kanban List page added, content in deployment</li> 
                <li class="arrow"> Price display updated in Devices menu</li> 
                <li class="arrow"> Knowledgebase type and Site type configurations had been updated on administrative side</li> 
                <li class="arrow"> Translation of site progressed to 80% of completion, language choice will be added</li> 
            </ul>
            <b>Bugfixes</b>
             <ul>
                <li class="arrow"> Devnotes display error fixed, RCA invalid class path</li> 
                <li class="arrow"> Group removal functionality issue resolved, due to script change</li> 
            </ul>
        </div>
        <hr class="dashed">
        <strong>Version 2.01.04 - PLANNED</strong><br />
            <div style="padding-left: 1em;">
                <strong> Translation decks </strong>
                <ul>
                    <li class="arrow"> Language select to Profile section </li> 
                    <li class="arrow"> Translating remaining parts </li> 
                </ul>
                
                <strong>Calendar</strong>
                <ul>
                    <li class="arrow">Recurring events support.</li>
                    <li class="arrow">Event view, edit, remove will be available.</li>
                </ul>
                
                <strong>Kanban list</strong>
                <ul>
                    <li class="arrow">Kanban-style list organization including ToDo, In Progress, Done, and Aborted.</li>
                    <li class="arrow">Key elements such as Name, Details, Date & Time, Location, Creation Date, Edit Date, and Group.</li>
                    <li class="arrow">Quick toggles for List View, Edit, and Delete operations.</li>
                </ul>
                    
                <strong>Grocery List</strong>
                <ul>
                    <li class="arrow">Swift item addition with just Name and Add.</li>
                    <li class="arrow">Convenient options for check-marking items and deletion.</li>
                    <li class="arrow">Home page display showcasing remaining items.</li>
                </ul>
            
                <strong>Purchases</strong>
                <ul>
                    <li class="arrow">Flexibility to select preferred currency and set quantity.</li>
                </ul>
            
                <strong>Administrator</strong>
                <ul>
                    <li class="arrow">Resolving issues related to group deletion.</li>
                    <li class="arrow">Facilitating modifications of associated data for groups.</li>
                    <li class="arrow">Streamlining removal processes for sites and clients.</li>
                    <li class="arrow">Removal of document types for smoother operation.</li>
                    <li class="arrow">Removal public Users list.</li>
                    <li class="arrow">Adding contacts menu to "Informations".</li>
                    
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
                <li class="arrow"> Notification highlight on frontpage for coming event</li> 
                <li class="arrow"> Removing or modifying events in Calendar</li> 
                <li class="arrow"> Database and display had recieved extended functions for linking</li> 
                <li class="arrow"> Links with redirection for each password can be optionally set up</li> 
                <li class="arrow"> Private password storages are now available</li> 
                <li class="arrow"> Simpler data copying to cutboard by single click</li> 
                <li class="arrow"> Notification of successfull event trigger </li> 
            </ul>
            <b>Bugfixes</b>
             <ul>
                <li class="arrow"> Link prefix error on new content</li> 
                <li class="arrow"> Calendar data sorting and format fixed with "Y.m.d. (D)" format</li> 
            </ul>
        </div>
        <hr class="dashed">
        <strong>Version 2.01.02 - DEPLOYED</strong><br />
            <div style="padding-left: 1em;">
                <b>Updates</b>
                <ul>
                    <li class="arrow"> Updated user dashboard showcasing statistical data and upcoming events </li> 
                    <li class="arrow"> Dashboard upgrade inspired by the article at [AnyChart]. </li> 
                    <li class="arrow"> Language switch functionality, including translation files for multiple languages and centralized translation classes for consistent output. </li> 
                </ul>
            </div>
        <hr class="dashed">
        <strong>Version 2.01.01 - DEPLOYED</strong><br />
            <div style="padding-left: 1em;">
                <b>Updates</b>
                <ul>
                    <li class="arrow"> Calendar with events, powered by [jQueryScript].</li> 
                    <li class="arrow"> Added the "Add Event" button for ease of use.</li> 
                    <li class="arrow"> Revamped style and configuration for a better user experience.</li> 
                    <li class="arrow"> Visual upgrade across pages and forms, with improved loading functionality, descriptions for each page, and enhanced aesthetics. </li> 
                    <li class="arrow"> Thorough validation to ensure all file paths are sourced from a global variable. </li> 
                    <li class="arrow"> Backend optimization, resulting in improved page loading times. </li> 
                    <li class="arrow">  Device table and parameters creation.</li> 
                    <li class="arrow"> Device page creation and seamless integration with file storage.</li> 
                    <li class="arrow"> Secure device password storage.</li> 
                    <li class="arrow"> Password storage table and parameters creation.</li> 
                    <li class="arrow"> Password storage page creation and integration with file storage.</li> 
                    <li class="arrow"> Password storage linkage for easy access to passwords.</li> 
                </ul>
                <b>Bugfixes</b>
                <ul>
                    <li class="arrow">  BugFix on faulty display of privileges on the profile </li> 
                </ul>
            </div>
        <hr class="dashed">
        <strong>Version 2.01.01 - DISCARDED</strong><br />
            <div style="padding-left: 1em;">
               <b>Bugfixes</b>
                <ul>
                    <li class="arrow"> Discarded the creation of dynamic tables for param_table, param_col, and param_val in favor of more efficient alternatives.</li> 
                </ul>
            </div>';
}