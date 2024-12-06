<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Data\{
    dUser
    ,dGroup
    ,dGroup_Member
    ,dHuntgroup
    ,dHuntgroup_Member
    ,dCombined
    ,dTools
    ,dLog
    ,dKnowledge
    ,dKnowledge_File
    ,dKnowledge_Type
    ,dCompany_Site_Type
};

use Samples\{
    sCard
    ,sTables
    ,sTranslate
    ,sForm
};

class sAdministrative {
/** @var object $dUser dUser class object */
    protected static $dUser;
/** @var object $dGroup dGroup class object */
    protected static $dGroup;
/** @var object $dGroup_Member dGroup_Member class object */
    protected static $dGroup_Member;
/** @var object $dHuntgroup dHuntgroup class object */
    protected static $dHuntgroup;
/** @var object $dHuntgroup_Member dHuntgroup_Member class object */
    protected static $dHuntgroup_Member;
/** @var object $dCombined dCombined class object */
    protected static $dCombined;
/** @var object $dTools dTools class object */
    protected static $dTools;
/** @var object $dLog dLog class object */
    protected static $dLog;
/** @var object $dKnowledge dKnowledge class object */
    protected static $dKnowledge;
/** @var object $dKnowledge_File dKnowledge_File class object */
    protected static $dKnowledge_File;
/** @var object $dKnowledge_Type dKnowledge_Type class object */
    protected static $dKnowledge_Type;
/** @var object $dCompany_Site_Type dCompany_Site_Type class object */
    protected static $dCompany_Site_Type;
/**
 * Sets the class object : dUser
 *
 * @author Liszi Dániel
 */
    protected static function setDUser()
    {
        self::$dUser = new dUser();
    }
/**
 * Sets the class object : dGroup
 *
 * @author Liszi Dániel
 */
    protected static function setDGroup()
    {
        self::$dGroup = new dGroup();
    }
/**
 * Sets the class object : dGroup_Member
 *
 * @author Liszi Dániel
 */
    protected static function setDGroup_Member()
    {
        self::$dGroup_Member = new dGroup_Member();
    }
/**
 * Sets the class object : dGroup
 *
 * @author Liszi Dániel
 */
    protected static function setDHuntgroup()
    {
        self::$dHuntgroup = new dHuntgroup();
    }
/**
 * Sets the class object : dGroup_Member
 *
 * @author Liszi Dániel
 */
    protected static function setDHuntgroup_Member()
    {
        self::$dHuntgroup_Member = new dHuntgroup_Member();
    }
/**
 * Sets the class object : dCombined
 *
 * @author Liszi Dániel
 */
    protected static function setDCombined()
    {
        self::$dCombined = new dCombined();
    }
/**
 * Sets the class object : dTools
 *
 * @author Liszi Dániel
 */
    protected static function setDTools()
    {
        self::$dTools = new dTools();
    }
/**
 * Sets the class object : dTools
 *
 * @author Liszi Dániel
 */
    protected static function setDLog()
    {
        self::$dLog = new dLog();
    }
/**
 * Sets the class object : dTools
 *
 * @author Liszi Dániel
 */
    protected static function setDKnowledge()
    {
        self::$dKnowledge = new dKnowledge();
    }
/**
 * Sets the class object : dTools
 *
 * @author Liszi Dániel
 */
    protected static function setDKnowledge_File()
    {
        self::$dKnowledge_File = new dKnowledge_File();
    }
/**
 * Sets the class object : dTools
 *
 * @author Liszi Dániel
 */
    protected static function setDKnowledge_Type()
    {
        self::$dKnowledge_Type = new dKnowledge_Type();
    }
/**
 * Sets the class object : dTools
 *
 * @author Liszi Dániel
 */
    protected static function setDCompany_Site_Type()
    {
        self::$dCompany_Site_Type = new dCompany_Site_Type();
    }
/**
 * User interactions/events/actions are handled here
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
   public static function Action(array $array): string
   {
        $classIdentifier = '\\Page\\Actions\\'.$array['y'];
        $wclass = new $classIdentifier();
        $returnContent = $wclass->{$array['z']}($array);

        if (Valid::vString($returnContent)) {
            $returnContent = '<div class="text-center justification-centered">'.$returnContent.'</div>';
        }

      return $returnContent;
	}
/**
 * Users page display
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Users(array $array): string
    {
        self::setDCombined();

        $returnString = '';
        $Users = self::$dCombined->Select(array(), 'Member_Full');

        if (isset($array['path'])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array['path']));
        }

        $returnString .= sTables::Prompt($Users, 'ADMIN_USERS');
        return $returnString;
    }
/**
 * Groups page display
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Groups(array $array): string
    {
        self::setDGroup();

        $returnString = '';
        $Groups = self::$dGroup->Select(array(), 'All');

        if (Valid::vString($array['path'])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array['path']));
        }

        $returnString .= sTables::Prompt($Groups, 'ADMIN_GROUPS');
        return $returnString;
    }
/**
 * Huntgroups page display
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Huntgroups(array $array): string
    {
        self::setDHuntgroup();

        $returnString = '';
        $Huntgroups = self::$dHuntgroup->Select(array(), 'All');

        if (Valid::vString($array['path'])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array['path']));
        }

        $returnString .= sTables::Prompt($Huntgroups, 'ADMIN_HUNTGROUPS');
        return $returnString;
    }
/**
 * Tools page display
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Tools(array $array): string
    {
        $returnString = '';
        $nestedPages = array(
            'Logs'
            ,'Knowledge_Type'
            ,'Company_Site_Type'
        );

        if (isset($_POST['c']) && in_array($_POST['c'], $nestedPages)) {
            $wclass = new \Page\Actions\Tools;

            switch ($_POST['c']) {
                case 'Logs':
                    $returnString .= $wclass::Logs($array);
                    break;
                case 'Knowledge_Type':
                    $returnString .= $wclass::Knowledge_Type($array);
                    break;
                case 'Company_Site_Type':
                    $returnString .= $wclass::Company_Site_Type($array);
                    break;
            }
        } else {
            if (Valid::vString($array['path'])) {
                $returnString .=
                    sCard::Collapsible(sTranslate::Info($array['path']))
                    .'<div class="card-columns m-2">'
                        .sCard::Blank(array('color' => 'secondary','title' => 'Felhasználói események','button' => sForm::Button(array('color' => 'success','fa' => 'search','text' => ' Megtekintés','path' => $array['path'].'/Logs','nonModal' => true))))
                        .sCard::Blank(array('color' => 'secondary','title' => 'Tudáscikk típusok','button' => sForm::Button(array('color' => 'success','fa' => 'search','text' => ' Megtekintés','path' => $array['path'].'/Knowledge_Type','nonModal' => true))))
                        .sCard::Blank(array('color' => 'secondary','title' => 'Telephely típusok','button' => sForm::Button(array('color' => 'success','fa' => 'search','text' => ' Megtekintés','path' => $array['path'].'/Company_Site_Type','nonModal' => true))))
//                      .sCard::Blank(array('color' => 'secondary','title' => 'Adatbázis alaphelyzetbe állítása','button' => sForm::Button(array('color' => 'danger','fa' => 'trash','text' => ' Végrehajt','path' => $array['path'].'/Delete','dp' => 'Database'))))
                    .'</div>';

            }
        }

        return $returnString;
    }
}
