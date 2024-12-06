<?php

declare(strict_types=1);

namespace Page\Actions;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Samples\{
    sTables
    ,sTranslate
    ,sForm
    ,sElement
};

use Database\Table;

class Tools extends \Page\Classes\sAdministrative
{
    public static function Delete(array $array = array()): string
    {
        self::setDTools();
        $bool = self::$dTools->Delete(array(), 'Database');
        $returnContent = ($bool)
            ? sTranslate::ACTION['Success']['content']
            : sTranslate::ACTION['Fail']['content'];

        if ($bool) {
            unset($_SESSION);
        }

        if (! isset($_SESSION)) {
            $Table = new Table();

            if (!isset($_SESSION['Database'])) {
                if ( $Table::initTable() === true) {
                    $_SESSION['Database'] = true;
                }
            }
        }
        return '<h4>'.$returnContent.'</h4>'.sForm::Spinner(array('x' => 'Home', 'reload' => true));
    }

    public static function Logs(): string
    {
        self::setDLog();
        $Logs = self::$dLog->Select(array(), 'All');
        return sTables::Prompt($Logs, 'ADMIN_LOGS');
    }
}
