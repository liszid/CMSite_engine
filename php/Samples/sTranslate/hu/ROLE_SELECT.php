<?php

declare(strict_types=1);

namespace Samples\sTranslate\hu;

interface ROLE_SELECT
{
     const ROLE_SELECT = array(
         'state' => array(
             array('id' => 0, 'name' => 'Disabled'),
             array('id' => 1, 'name' => 'Enabled')
         ),
         'access' => array(
             array('id' => 0, 'name' => 'Disabled'),
             array('id' => 1, 'name' => 'Read'),
             array('id' => 3, 'name' => 'Write/Read'),
             array('id' => 7, 'name' => 'Full')
         )
     );
}