<?php

declare(strict_types=1);

namespace Samples\sTranslate\hu;

interface ACTION
{
     const ACTION = array(
         'Success' => array(
             'content' => 'Sikeres!'
         )
         ,'Fail' => array(
             'content' => 'Sikertelen!'
         )
         ,'Tables' =>array(
             'edit' => 'Szerkesztés'
             ,'view' => 'Megtekintés'
             ,'delete' => 'Törlés'
         )
     );
}