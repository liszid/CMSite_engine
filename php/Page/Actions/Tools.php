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

use Data\{
    dKnowledge
    ,dKnowledge_File
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

    public static function Company_Site_Type(array $array): string
    {
        if (! isset($array['zn'])) {
            self::setDCompany_Site_Type();
            $Company_Site_Types = self::$dCompany_Site_Type->Select(array(), 'All');
            return sTables::Prompt($Company_Site_Types, 'ADMIN_COMPANY_SITE_TYPE');
        } else {
            switch ($array['zn']) {
                case 'Add':
                    return self::Company_Site_Type_Add($array);
                    break;
                case 'Edit':
                    return self::Company_Site_Type_Edit($array);
                    break;
                case 'Delete':
                    return self::Company_Site_Type_Delete($array);
                    break;
            }
        }
    }

    public static function Company_Site_Type_Add(array $array): string
    {
        return 'Add';
    }
    public static function Company_Site_Type_Edit(array $array): string
    {
        return 'Edit';
    }
    public static function Company_Site_Type_Delete(array $array): string
    {
        return 'Delete';
    }

    public static function Knowledge_Type(array $array): string
    {
        if (! isset($array['zn'])) {
            self::setDKnowledge_Type();
            $Knowledge_Types = self::$dKnowledge_Type->Select(array(), 'All');
            return sTables::Prompt($Knowledge_Types, 'ADMIN_KNOWLEDGE_TYPE');
        } else {
            switch ($array['zn']) {
                case 'Add':
                    return self::Knowledge_Type_Add($array);
                    break;
                case 'Edit':
                    return self::Knowledge_Type_Edit($array);
                    break;
                case 'Delete':
                    return self::Knowledge_Type_Delete($array);
                    break;
            }
        }
    }

    public static function Knowledge_Type_Add(array $array): string
    {
        return 'Add';
    }
    
    public static function Knowledge_Type_Edit(array $array): string
    {
        return 'Edit';
    }
    
    public static function Knowledge_Type_Delete(array $array): string
    {
        return 'Delete';
    }
}
