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
        );

        if (isset($_POST['c']) && in_array($_POST['c'], $nestedPages)) {
            $wclass = new \Page\Actions\Tools;

            switch ($_POST['c']) {
                case 'Logs':
                    $returnString .= $wclass::Logs($array);
                    break;
            }
        } else {
            if (Valid::vString($array['path'])) {
                $returnString .=
                    sCard::Collapsible(sTranslate::Info($array['path']))
                    .'<div class="card-columns m-2">'
                        .sCard::Blank(array('color' => 'secondary','title' => 'Felhasználói események','button' => sForm::Button(array('color' => 'success','fa' => 'search','text' => ' Megtekintés','path' => $array['path'].'/Logs','nonModal' => true))))
                    .'</div>';

            }
        }

        return $returnString;
    }
}
