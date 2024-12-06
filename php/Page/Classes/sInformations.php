<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Data\{
    dPasstorage
    ,dAccess
    ,dPasstorage_File
    ,dKnowledge
    ,dKnowledge_File
    ,dHardware
    ,dHardware_File
    ,dKnowledge_Type
    ,dCombined
    ,dCompany
    ,dHuntgroup
    ,dHuntgroup_Member
};

use Samples\{
    sCard
    ,sTables
    ,sTranslate
    ,sForm
    ,sFrame
};

class sInformations
{
/** @var object $dHardware dHardware class object */
    protected static $dHardware;
/** @var object $dHardware_File dHardware_File class object */
    protected static $dHardware_File;
/** @var object $dCombined dCombined class object */
/** @var object $dAccess dAccess class object */
    protected static $dAccess;
/** @var object $dPasstorage dPasstorage class object */
    protected static $dPasstorage;
/** @var object $dPasstorage_File dPasstorage_File class object */
    protected static $dPasstorage_File;
/** @var object $dKnowledge Class container variable */
    protected static $dKnowledge;
/** @var object $dKnowledge_File Class container variable */
    protected static $dKnowledge_File;
/** @var object $dKnowledge_Type Class container variable */
    protected static $dKnowledge_Type;
/** @var object $dCompany Class container variable */
    protected static $dCompany;
/** @var object $dCombined dCombined class object */
    protected static $dCombined;
/** @var object $dHuntgroup dHuntgroup class object */
    protected static $dHuntgroup;
/** @var object $dHuntgroup_Member dHuntgroup_Member class object */
    protected static $dHuntgroup_Member;
/** @var const RETURN_PATH Used to define Spinner return path */
    const RETURN_PATH=array(
        'Access' => array('x' => 'Informations', 'y' => 'Access')
        ,'Knowledge' => array('x' => 'Informations', 'y' => 'Knowledge')
        ,'Passtorage' => array('x' => 'Informations', 'y' => 'Passtorage')
        ,'Device' => array('x' => 'Informations', 'y' => 'Device')
    );
/** @var const Insance Data form variables/elements */
    const FORMDATA = array(
        'Access' => array(
            array('data' => 'accessId', 'desc' => '', 'type' => 'hidden', 'tags' => 'Edit')
            ,array('data' => 'accessUsername', 'desc' => 'Felhasználónév', 'type' => 'text', 'tags' => 'Add,Edit,View', 'must-fill' => true)
            ,array('data' => 'accessPassword', 'desc' => 'Jelszó', 'type' => 'text', 'tags' => 'Add,Edit,View', 'must-fill' => true)
    		,array('data' => 'accessLabel', 'desc' => 'Cimke', 'type' => 'text', 'tags' => 'Add,Edit,View', 'must-fill' => true)
            ,array('data' => 'accessLink', 'desc' => 'Hivatkozás', 'type' => 'text', 'tags' => 'Add,Edit,View', 'must-fill' => true)
            ,array('data' => 'passtorageId', 'desc' => 'Tároló', 'type' => 'layeredselect', 'tags' => 'Add,View,Edit')
        )
        , 'Device' => array(
            array('data' => 'hardwareId', 'desc' => '', 'type' => 'hidden', 'tags' => 'Edit')
            ,array('data' => 'hardwareName', 'desc' => 'Megnevezés', 'type' => 'text', 'tags' => 'Add,View,Edit', 'must-fill' => true)
            ,array('data' => 'hardwareDesc', 'desc' => 'Leírás', 'type' => 'text', 'tags' => 'Add,View,Edit')
    		,array('data' => 'hardwarePrice', 'desc' => 'Beszerzési ár', 'type' => 'text', 'tags' => 'Add,View,Edit')
    		,array('data' => 'hardwareGuaranteeDate', 'desc' => 'Garancia dátuma', 'type' => 'date', 'tags' => 'Add,View,Edit')
            ,array('data' => 'hardwareDateIn', 'desc' => 'Beszerzés dátuma', 'type' => 'date', 'tags' => 'Add,View,Edit')
            ,array('data' => 'companySiteId', 'desc' => 'Telephely', 'type' => 'layeredselect', 'tags' => 'Add,View,Edit')
        )
        , 'Knowledge' => array(
            array('data' => 'knowledgeId', 'desc' => '', 'type' => 'hidden', 'tags' => 'Edit')
            ,array('data' => 'companyId', 'desc' => 'Cég', 'type' => 'selectpicker', 'tags' => 'Add,View,Edit')
            ,array('data' => 'knowledgeTitle', 'desc' => 'Cím', 'type' => 'text', 'tags' => 'Add,Edit,View', 'must-fill' => true)
            ,array('data' => 'knowledgeTypeId', 'desc' => 'Típus', 'type' => 'selectpicker', 'tags' => 'Add,Edit,View', 'must-fill' => true)
            ,array('data' => 'knowledgeText', 'desc' => 'Leírás', 'type' => 'ckeditor', 'print' => true, 'tags' => 'Add,View,Edit')
            ,array('data' => 'knowledgeLabel', 'desc' => 'Címkék', 'type' => 'text', 'tags' => 'Add,View,Edit')
        )
        , 'Passtorage' => array(
            array('data' => 'passtorageId', 'desc' => '', 'type' => 'hidden', 'tags' => 'Edit')
            ,array('data' => 'passtorageName', 'desc' => 'Megnevezés', 'type' => 'text', 'tags' => 'Add,View,Edit', 'must-fill' => true)
            ,array('data' => 'passtorageDesc', 'desc' => 'Leírás', 'type' => 'text', 'tags' => 'Add,View,Edit')
            ,array('data' => 'companySiteId', 'desc' => 'Telephely', 'type' => 'layeredselect', 'tags' => 'Add,View,Edit')
        )
    );
    
/** @var const PASSTORAGE Stores an instance of variable used at forms */
    const UPLOAD_HARDWARE = array(
        array('data' => 'hardwareId', 'desc' => '', 'type' => 'hidden', 'tags' => 'Edit')
        ,array('data' => 'fileToUpload', 'desc' => 'Fájl', 'type' => 'file', 'tags' => 'View,Edit')
    );
/** @var const PASSTORAGE Stores an instance of variable used at forms */
    const UPLOAD_PASSTORAGE = array(
        array('data' => 'passtorageId', 'desc' => '', 'type' => 'hidden', 'tags' => 'Edit')
        ,array('data' => 'fileToUpload', 'desc' => 'Fájl', 'type' => 'file', 'tags' => 'View,Edit')
    );
/** @var const KNOWLEDGE Stores an instance of variable used at forms */
    const UPLOAD_KNOWLEDGE = array(
        array('data' => 'knowledgeId', 'desc' => '', 'type' => 'hidden', 'tags' => 'Edit')
        ,array('data' => 'fileToUpload', 'desc' => 'Fájl', 'type' => 'file', 'tags' => 'View,Edit')
    );
/** @var const TYPES Used for getting page specific variables, like form element IDs, form elements, tables */
    const TYPES = array(
        "Passtorage" => array(
            "origo" => 'usrInfosPasstorage'
            ,"tableQuery" => 'Passtorage_Members_All'
            ,"tableName" => 'PASSTORAGE_LAPTOP'
        )
        , "Access" => array(
            "origo" => 'usrAccess'
            ,"tableQuery" => 'Access_Table'
            ,"tableName" => 'ACCESS_ACCESS'
        )
        , "Knowledge" => array(
            "origo" => 'usrKnowledgeKnowledge'
            ,"tableQuery" => 'Knowledge_Table'
            ,"tableName" => 'KNOWLEDGE_KNOWLEDGE'
        )
		, "Device" => array(
            "origo" => 'usrInfosDevice'
            ,"tableQuery" => 'Hardware_Members_All'
            ,"tableName" => 'HARDWARE_DEVICE'
        )
    );
/**
 * Sets the class object : dHardware
 *
 * @author Liszi Dániel
 */
    protected static function setDHardware()
    {
        self::$dHardware = new dHardware();
    }
/**
 * Sets the class object : dHardware_File
 *
 * @author Liszi Dániel
 */
    protected static function setDHardware_File()
    {
        self::$dHardware_File = new dHardware_File();
    }
/**
 * Sets the class object : dPasstorage
 *
 * @author Liszi Dániel
 */
    protected static function setDAccess()
    {
        self::$dAccess= new dAccess();
    }
/**
 * Sets the class object : dPasstorage
 *
 * @author Liszi Dániel
 */
    protected static function setDPasstorage()
    {
        self::$dPasstorage = new dPasstorage();
    }
/**
 * Sets the class object : dPasstorage_File
 *
 * @author Liszi Dániel
 */
    protected static function setDPasstorage_File()
    {
        self::$dPasstorage_File = new dPasstorage_File();
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
 * Sets the class object : dHuntgroup
 *
 * @author Liszi Dániel
 */
    protected static function setDHuntgroup()
    {
        self::$dHuntgroup = new dHuntgroup();
    }
/**
 * Sets the class object : dHuntgroup_Member
 *
 * @author Liszi Dániel
 */
    protected static function setDHuntgroup_Member()
    {
        self::$dHuntgroup_Member = new dHuntgroup_Member();
    }
/**
 * Sets the class variable : dKnowledge
 *
 * @author Liszi Dániel
 */
    protected static function setDKnowledge()
    {
        self::$dKnowledge= new dKnowledge();
    }
/**
 * Sets the class variable : dKnowledge_File
 *
 * @author Liszi Dániel
 */
    protected static function setDKnowledge_File()
    {
        self::$dKnowledge_File = new dKnowledge_File();
    }
/**
 * Sets the class variable : dKnowledge_Type
 *
 * @author Liszi Dániel
 */
    protected static function setDKnowledge_Type()
    {
        self::$dKnowledge_Type = new dKnowledge_Type();
    }
/**
 * Sets the class variable : dCompany
 *
 * @author Liszi Dániel
 */
    protected static function setDCompany()
    {
        self::$dCompany = new dCompany();
    }
/**
 * Handles the page actions, events, launched by users
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	public static function Action(array $array): string
	{
	    $array['defaultData'] = self::FORMDATA[$array['y']];
		$array['origo'] = self::TYPES[$array['y']]['origo'].$array['z'];
		$array['returnPath'] = self::RETURN_PATH[$array['y']];
		$returnContent = self::{$array['z']}($array);
		
		if (Valid::vString($returnContent)) {
			$returnContent = '<div class="text-center justification-centered">'.$returnContent.'</div>';
		}
		
		return $returnContent;
    }
/**
 * Loads the page using the TYPES as reference
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Page(array $array): string
    {
        self::setDCombined();
        $returnString = '';
        $fQuery = (strcmp($array['y'],'Passtorage'))?'Passtorage_Members_Select':((strcmp($array['y'],'Device'))?'Hardware_Members_Select':'');
		$fClass = (! empty($fQuery))?self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), $fQuery):'';
		if (isset($array['path'])) {
			$returnString .= sCard::Collapsible(sTranslate::Info($array['path']));
		}
		$returnString .= sTables::Prompt($fClass, self::TYPES[$array['y']]['tableName']);

        return $returnString;
    }
/**
 * Loads the Hardware/Hardware page, which shows all available data
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function ClassPage(array $array): string
    {
        self::setDCombined();
        $returnString = '';
        $cPath = explode('/', $array['path']);
        $Combined = self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), self::TYPES[$cPath[1]]['tableQuery']);

        if (isset($array['path'])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array['path']));
        }

        $returnString .= sTables::Prompt($Combined, self::TYPES[$cPath[1]]['tableName']);
        return $returnString;
    }
/**
 * Generates a Select list to choose the Location of the item
 *
 * @return array
 *
 * @author Liszi Dániel
 */
    protected static function Company_Site_Select(): array
    {
        self::setDCombined();
        $tempArray = array();
        foreach(self::$dCombined->Select(array(), 'Company_Site_Select') as $i) {
        		if(! isset($tempArray[$i['companyName']])) {
					$tempArray[$i['companyName']] = array(); 
        		}
            $tempArray[$i['companyName']][] = array('id' => $i['companySiteId'], 'name' => $i['companySiteName']);
        }
        return $tempArray;
    }
/**
 * Passtorage selection
 *
 * @return array
 *
 * @author Liszi Dániel
 */
    protected static function Passtorage_Select(): array
    {
        self::setDCombined();

        $tempArray = array();
        foreach(self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), 'Passtorage_Members_All') as $i) {
        		if(! isset($tempArray[$i['passtorageType']])) {
					$tempArray[$i['passtorageType']] = array(); 
        		}
            $tempArray[$i['passtorageType']][] = array('id' => $i['passtorageId'], 'name' => $i['passtorageName']);
        }
        return $tempArray;
    }
/**
 * Generates a Select list to choose the Location of the item
 *
 * @return array
 *
 * @author Liszi Dániel
 */
    protected static function Knowledge_Type_Select(): array
    {
        self::setDKnowledge_Type();
        $tempArray = array();
        foreach(self::$dKnowledge_Type->Select(array(), 'All') as $i) {
            $tempArray[] = array('id' => $i['knowledgeTypeId'], 'name' => $i['knowledgeTypeName']);
        }
        return $tempArray;
    }
/**
 * Generates a Select list to choose the Company ID of the item
 *
 * @return array
 *
 * @author Liszi Dániel
 */
    protected static function Company_Select(): array
    {
        self::setDCompany();
        $tempArray = array();
        foreach(self::$dCompany->Select(array(), 'All') as $i) {
            $tempArray[] = array('id' => $i['companyId'], 'name' => $i['companyName']);
        }
        return $tempArray;
    }

/**
 * Generates a Checkbox panel to select which groups can see the item
 *
 * @param $array array
 * @param $bool bool
 *
 * @return string
 *
 * @author Liszi Daniel
 */
    protected static function Huntgroup_Checkbox(array $array, bool $bool = false): string
    {
        self::setDHuntgroup();
        self::setDCombined();

        $AllUsers = self::$dHuntgroup->Select(array(), 'All');
		$HGUsers = array();

		switch($array['y']){
	        case 'Passtorage':
				$HGUsers = self::$dCombined->Select(array('passtorageId' => (int)$array['dp']), 'Passtorage_Members');
				break;
			case 'Device':
				$HGUsers = self::$dCombined->Select(array('hardwareId' => (int)$array['dp']), 'Hardware_Members');
				break;
		}
		
        $returnString = '
        <div class="form-group col-12 h-100">
            <label for="'.$array['origo'].'-huntgroupCheckbox">Csoportok</label>
            <select multiple size="10"'.(($bool)?' disabled':'').' class="form-control" id="'.$array['origo'].'-huntgroupCheckbox">
        ';

        foreach($AllUsers as $i) {
            $returnString .= '
                <option'.((! is_null($HGUsers) && array_search($i['huntgroupId'], array_column($HGUsers, 'huntgroupId')) !== false )?' selected':'').' value="'.$i['huntgroupId'].'">
                    '.$i['huntgroupName'].'
                </option>';
        }

        $returnString .= '
            </select>
          </div>
        ';

        return $returnString;
    }
/**
* Generates Passtorage::Add form and handles its action
*
* @param $array array
*
* @return string
*
* @author Liszi Dániel
*/
    public static function Add(array $array): string
    {
	    switch($array['y']){
	        case 'Passtorage':
                self::setDPasstorage();
                if (! isset($array['Save'])) {
                    return '
                        <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                            <div class="form-group col p-0">
                                <div class="col-12 row">'
                                    .sForm::Input(array('origo' => $array['origo'],'data' => 'userId','desc' => '','value' => $GLOBALS['sessionId'],'type' => 'hidden'))
                                    .sForm::Input(array('origo' => $array['origo'],'data' => 'passtorageType','desc' => '','value' => $array['passtorageType'],'type' => 'hidden'))
                                    .sForm::Generate(array('constData' => self::FORMDATA[$array['y']],'staticData' => array('origo' => $array['origo'], 'tag' => 'Add'),'selectData' => array('companySiteId' => self::Company_Site_Select())))
                                .'</div>
                            </div>
                            <div class="form-group">
                                <div class="col-12 row">
                                    <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="'.$array['origo'].'-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                                </div>
                            </div>
                        </form>';
                } else {
                    return
                        '<h4>'.(
                            (self::$dPasstorage->Insert($array))
                                ? sTranslate::ACTION['Success']['content']
                                : sTranslate::ACTION['Fail']['content']
                        ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
                }
                break;
            case 'Access':
                self::setDAccess();
                if (! isset($array['Save'])) {
                    return '
                        <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                            <div class="form-group col p-0">
                                <div class="col-12 row">'
                                    .sForm::Input(array('origo' => 'usrAccessAdd', 'data' => 'userId', 'desc' => '', 'value' => $GLOBALS['sessionId'], 'type' => 'hidden'))
                                    .sForm::Generate(array('constData' => self::FORMDATA[$array['y']], 'staticData' => array('origo' => 'usrAccessAdd', 'tag' => 'Add'), 'selectData' => array('passtorageId' => self::Passtorage_Select())))
                                .'</div>
                            </div>
                            <div class="form-group">
                                <div class="col-12 row">
                                    <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="usrAccessAdd-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                                </div>
                            </div>
                        </form>';
                } else {
                    return
                        '<h4>'.(
                            (self::$dAccess->Insert($array))
                                ? sTranslate::ACTION['Success']['content']
                                : sTranslate::ACTION['Fail']['content']
                        ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
                }
                break;
            case 'Knowledge':
                self::setDKnowledge();
                if (! isset($array['Save'])) {
                    return '
                        <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                            <div class="form-group col p-0">
                                <div class="col-12">'
                                    .sForm::Input(array('origo' => $array['origo'], 'data' => 'userId', 'desc' => '', 'value' => $GLOBALS['sessionId'], 'type' => 'hidden'))
                                    .sForm::Generate(array('constData' => self::FORMDATA[$array['y']],'staticData' => array('origo' => $array['origo'], 'tag' => 'Add'),'selectData' => array('knowledgeTypeId' => self::Knowledge_Type_Select(), 'companyId' => self::Company_Select())))
                                .'</div>
                            </div>
                            <div class="form-group">
                                <div class="col-12 row">
                                    <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="'.$array['origo'].'-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                                </div>
                            </div>
                        </form>';
                } else {
                    return '<h4>'.(
                            (self::$dKnowledge->Insert($array))
                                ? sTranslate::ACTION['Success']['content']
                                : sTranslate::ACTION['Fail']['content']
                            ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
                }
                break;
			case 'Device':
				self::setDHardware();
				if (! isset($array['Save'])) {
					return '
						<form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
							<div class="form-group col p-0">
								<div class="col-12 row">'
                                    .sForm::Input(array('origo' => $array['origo'],'data' => 'userId','desc' => '','value' => $GLOBALS['sessionId'],'type' => 'hidden'))
									.sForm::Generate(array('constData' => self::FORMDATA[$array['y']],'staticData' => array('origo' => $array['origo'], 'tag' => 'Add'),'selectData' => array('companySiteId' => self::Company_Site_Select())))
								.'</div>
							</div>
							<div class="form-group">
								<div class="col-12 row">
									<button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="'.$array['origo'].'-button"><i class="fa fa-floppy-o"></i> Mentés</button>
								</div>
							</div>
						</form>';
				} else {
					return
						'<h4>'.(
							(self::$dHardware->Insert($array))
								? sTranslate::ACTION['Success']['content']
								: sTranslate::ACTION['Fail']['content']
                        ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
				}
				break;
	    }
    }
/**
* Generates Passtorage::View form
*
* @param $array array
*
* @return string
*
* @author Liszi Dániel
*/
    public static function View(array $array): string
    {
	    switch($array['y']){
	        case 'Passtorage':
                self::setDPasstorage();
                self::setDPasstorage_File();
                $Passtorage = (self::$dPasstorage->Select(array('passtorageId' => (int)$array['dp']), 'byPasstorageId'))[0];
                $Passtorage_File = (self::$dPasstorage_File->Select(array('passtorageId' => (int)$array['dp']), 'byPasstorageId'));
                return '
                    <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                        <div class="form-group col p-0">
                            <div id="printThis" class="col-12 row">'
                                .sCard::Collapsible(array('header' => 'Általános adatok','content' => sForm::Generate(array('constData' => $array['defaultData'],'staticData' => array('origo' => $array['origo'],'tag' => 'View'),'valueData' => $Passtorage,'selectData' => array('companySiteId' => self::Company_Site_Select())))))
                                .sForm::Download(array('items' => $Passtorage_File,'fileId' => 'passtorageFileId','filePath' => 'passtorageFilePath','fileName' => 'passtorageFileName','fileDate' => 'passtorageFileDate','fileSize' => 'passtorageFileSize','fileType' => 'passtorageFileType','wClass' => 'Data\\dPasstorage_File'))
                                .sForm::Input(array('origo' => $array['origo'],'data' => 'userName','desc' => 'Hozzáadta','value' => $Passtorage['userName'],'type' => 'text', 'disabled' => true))
                                .sForm::Input(array('origo' => $array['origo'],'data' => 'passtorageDate','desc' => 'Hozzáadva','value' => $Passtorage['passtorageDate'], 'type' => 'text', 'disabled' => true))
                            .'</div>
                        </div>
                    </form>';
                break;
            case 'Access':
                self::setDAccess();
                self::setDPasstorage();
                $Access = (self::$dAccess->Select(array('accessId' => (int)$array['dp']), 'byAccessId'))[0];
                $Passtorage = (self::$dPasstorage->Select(array('passtorageId' => (int)$Access['passtorageId']), 'byPasstorageId'))[0];
                $Access['accessPassword'] = self::$dAccess->Decode($Access['accessPassword']);
                return '
                    <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                        <div class="form-group col p-0">
                            <div class="col-12 row">'
                                .sForm::Generate(array('constData' => self::FORMDATA[$array['y']],'staticData' => array('origo' => $array['origo'], 'tag' => 'View'), 'valueData' => $Access, 'selectData' => array('passtorageId' => self::Passtorage_Select())))
                                .sForm::Input( array('origo' => 'usrAccessView', 'data' => 'userName', 'desc' => 'Hozzáadta', 'value' => $Access['userName'], 'type' => 'text', 'disabled' => true), 'Input')
                                .sForm::Input( array('origo' => 'usrAccessView', 'data' => 'accessDate','desc' => 'Hozzáadva','value' => $Access['accessDate'], 'type' => 'text', 'disabled' => true), 'Input')
                            .'</div>
                        </div>
                    </form>';
                break;
            case 'Knowledge':
                self::setDKnowledge();
                self::setDKnowledge_File();
                $Knowledge = (self::$dKnowledge->Select(array('knowledgeId' => (int)$array['dp']), 'byKnowledgeId'))[0];
                $Knowledge_File = (self::$dKnowledge_File->Select(array('knowledgeId' => (int)$array['dp']), 'byKnowledgeId'));
                return '
                    <form method="post" class="text-left form-group col-12 p-0 m-0" autocomplete="on">
                        <div class="form-group col p-0">
                            <div class="col-12 row">'
                                .sForm::Generate(array('constData' => self::FORMDATA[$array['y']], 'staticData' => array('origo' => $array['origo'], 'tag' => 'View'),'selectData' => array('knowledgeTypeId' => self::Knowledge_Type_Select(), 'companyId' => self::Company_Select()), 'valueData' => $Knowledge))
                                .sForm::Download(array('items' => $Knowledge_File,'fileId' => 'knowledgeFileId','filePath' => 'knowledgeFilePath','fileName' => 'knowledgeFileName','fileDate' => 'knowledgeFileDate','fileSize' => 'knowledgeFileSize','fileType' => 'knowledgeFileType','wClass' => 'Data\\dKnowledge_File'))
                                .sForm::Input(array('origo' => $array['origo'],'data' => 'userName','desc' => 'Hozzáadta','value' => $Knowledge['userName'], 'type' => 'text', 'disabled' => true))
                                .sForm::Input(array('origo' => $array['origo'],'data' => 'knowledgeDate','desc' => 'Hozzáadva','value' => $Knowledge['knowledgeDate'], 'type' => 'text', 'disabled' => true))
                            .'</div>
                        </div>
                    </form>';
                break;
			case 'Device':
				self::setDHardware();
				self::setDHardware_File();

				$Hardware = (self::$dHardware->Select(array('hardwareId' => (int)$array['dp']), 'byHardwareId'))[0];
				$Hardware_File = (self::$dHardware_File->Select(array('hardwareId' => (int)$array['dp']), 'byHardwareId'));

				return '
					<form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
						<div class="form-group col p-0">
							<div id="printThis" class="col-12 row">'
								.sCard::Collapsible(array('header' => 'Általános adatok','content' => sForm::Generate(array('constData' => $array['defaultData'],'staticData' => array('origo' => $array['origo'],'tag' => 'View'),'valueData' => $Hardware,'selectData' => array('companySiteId' => self::Company_Site_Select())))))
								.sForm::Download(array('items' => $Hardware_File,'fileId' => 'hardwareFileId','filePath' => 'hardwareFilePath','fileName' => 'hardwareFileName','fileDate' => 'hardwareFileDate','fileSize' => 'hardwareFileSize','fileType' => 'hardwareFileType','wClass' => 'Data\\dHardware_File'))
								.sForm::Input(array('origo' => $array['origo'],'data' => 'userName','desc' => 'Hozzáadta','value' => $Hardware['userName'],'type' => 'text', 'disabled' => true))
								.sForm::Input(array('origo' => $array['origo'],'data' => 'hardwareDate','desc' => 'Hozzáadva','value' => $Hardware['hardwareDate'], 'type' => 'text', 'disabled' => true))
							.'</div>
						</div>
					</form>';
				break;
	    }
    }
/**
* Generates Passtorage::Edit form and handles its action
*
* @param $array array
*
* @return string
*
* @author Liszi Dániel
*/
    public static function Edit(array $array): string
    {
	    switch($array['y']){
	        case 'Passtorage':
                self::setDPasstorage();
                if (! isset($array['Save'])) {
                    $Passtorage = (self::$dPasstorage->Select(array('passtorageId' => (int)$array['dp']), 'byPasstorageId'))[0];
                    return '
                        <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                            <div class="form-group col p-0">
                                <div class="col-12 row">'
                                    .sForm::Input(array('origo' => $array['origo'],'data' => 'userId','desc' => '','value' => $GLOBALS['sessionId'],'type' => 'hidden'))
                                    .sForm::Input(array('origo' => $array['origo'],'data' => 'passtorageType','desc' => '','value' => $array['passtorageType'],'type' => 'hidden'))
                                    .sCard::Collapsible(array('header' => 'Általános adatok','content' => sForm::Generate(array('constData' => $array['defaultData'],'staticData' => array('origo' => $array['origo'],'tag' => 'Edit'),'valueData' => $Passtorage,'selectData' => array('companySiteId' => self::Company_Site_Select())))))
                                    .sCard::Collapsible(array('header' => 'Csoport adatok','content' => self::Huntgroup_Checkbox(array('dp' => $Passtorage['passtorageId'],'origo' => $array['origo']))))
                                .'</div>
                            </div>
                            <div class="form-group">
                                <div class="col-12 row">
                                    <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="'.$array['origo'].'-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                                </div>
                            </div>
                        </form>';
                } else {
                    return
                        '<h4>'.(
                            (self::$dPasstorage->Update($array))
                                ? sTranslate::ACTION['Success']['content']
                                : sTranslate::ACTION['Fail']['content']
                        ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
                }
                break;
            case 'Access':
                if (! isset($array['Save'])) {
                    self::setDAccess();
                    $Access = (self::$dAccess->Select(array('accessId' => (int)$array['dp']), 'byAccessId'))[0];
                    $Access['accessPassword'] = self::$dAccess->Decode($Access['accessPassword']);
                    return '
                        <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                            <div class="form-group col p-0">
                                <div class="col-12 row">'
                                    .sForm::Input(array('origo' => 'usrAccessEdit', 'data' => 'userId', 'desc' => '', 'value' => $GLOBALS['sessionId'], 'type' => 'hidden'))
                                    .sForm::Generate(array('constData' => self::FORMDATA[$array['y']],'staticData' => array('origo' => 'usrAccessEdit','tag' => 'Edit'),'valueData' => $Access,'selectData' => array('passtorageId' => self::Passtorage_Select())))
                                .'</div>
                            </div>
                            <div class="form-group">
                                <div class="col-12 row">
                                    <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="usrAccessEdit-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                                </div>
                            </div>
                        </form>';
                } else {
                    self::setDAccess();
        
                    return
                        '<h4>'.(
                            (self::$dAccess->Update($array))
                                ? sTranslate::ACTION['Success']['content']
                                : sTranslate::ACTION['Fail']['content']
                        ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
                }
                break;
            case 'Knowledge':
                self::setDKnowledge();
                if (! isset($array['Save'])) {
                    $Knowledge = (self::$dKnowledge->Select(array('knowledgeId' => (int)$array['dp']), 'byKnowledgeId'))[0];
        
                    return '
                        <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on" enctype="multipart/form-data">
                            <div class="form-group col p-0">
                                <div class="col-12 row">'
                                    .sForm::Input(array('origo' => $array['origo'], 'data' => 'userId', 'desc' => '', 'value' => $GLOBALS['sessionId'], 'type' => 'hidden'))
                                    .sForm::Generate(array('constData' => self::FORMDATA[$array['y']], 'staticData' => array('origo' => $array['origo'], 'tag' => 'Edit'),'selectData' => array('knowledgeTypeId' => self::Knowledge_Type_Select(), 'companyId' => self::Company_Select()), 'valueData' => $Knowledge))
                                .'</div>
                            </div>
                            <div class="form-group">
                                <div class="col-12 row">
                                    <button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="'.$array['origo'].'-button"><i class="fa fa-floppy-o"></i> Mentés</button>
                                </div>
                            </div>
                        </form>';
                } else {
                    return
                        '<h4>'.(
                            (self::$dKnowledge->Update($array))
                                ? sTranslate::ACTION['Success']['content']
                                : sTranslate::ACTION['Fail']['content']
                        ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
                }
                break;
			case 'Device':
				self::setDHardware();
				if (! isset($array['Save'])) {
					$Hardware = (self::$dHardware->Select(array('hardwareId' => (int)$array['dp']), 'byHardwareId'))[0];
					return '
						<form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
							<div class="form-group col p-0">
								<div class="col-12 row">'
									.sForm::Input(array('origo' => $array['origo'],'data' => 'userId','desc' => '','value' => $GLOBALS['sessionId'],'type' => 'hidden'))
									.sCard::Collapsible(array('header' => 'Általános adatok','content' => sForm::Generate(array('constData' => $array['defaultData'],'staticData' => array('origo' => $array['origo'],'tag' => 'Edit'),'valueData' => $Hardware,'selectData' => array('companySiteId' => self::Company_Site_Select())))))
									.sCard::Collapsible(array('header' => 'Csoport adatok','content' => self::Huntgroup_Checkbox(array('dp' => $Hardware['hardwareId'],'origo' => $array['origo']))))
								.'</div>
							</div>
							<div class="form-group">
								<div class="col-12 row">
									<button class="btn btn-lg btn-success col-12 col-md-6 ml-auto" type="submit" id="'.$array['origo'].'-button"><i class="fa fa-floppy-o"></i> Mentés</button>
								</div>
							</div>
						</form>';
				} else {
					return
						'<h4>'.(
							(self::$dHardware->Update($array))
								? sTranslate::ACTION['Success']['content']
								: sTranslate::ACTION['Fail']['content']
                        ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
				}
				break;
	    }
    }
/**
* Generates Passtorage::Upload form and handles the Update event
*
* @param $array array
*
* @return string
*
* @author Liszi Dániel
*/
    public static function Upload(array $array): string
    {
	    switch($array['y']){
	        case 'Passtorage':
                self::setDPasstorage();
                $Passtorage = (self::$dPasstorage->Select(array('passtorageId' => (int)$array['dp']), 'byPasstorageId'))[0];
                return '
                    <form action="" method="post" class="form-group col-12 p-0 m-0" autocomplete="on" enctype="multipart/form-data">
                        <div class="form-group col p-0">
                            <div class="col-12 row">'
                                .sForm::Input(array('origo' => $array['origo'],'data' => 'userId','desc' => '','value' => $GLOBALS['sessionId'],'type' => 'hidden'))
                                .sForm::Input(array('origo' => $array['origo'],'data' => 'classId','desc' => '','value' => self::$dPasstorage->Class_Id(),'type' => 'hidden'))
                                .sForm::Generate(array('constData' => self::UPLOAD_PASSTORAGE,'staticData' => array('origo' => $array['origo'],'tag' => 'Edit'),'valueData' => $Passtorage))
                            .'</div>
                        </div>
                        <div class="form-group">
                            <div class="col-12 row">
                                <input type="submit" class="btn btn-lg btn-success col-12 col-md-6 ml-auto" value="Mentés" id="'.$array['origo'].'-button">
                            </div>
                        </div>
                    </form>';
                break;
            case 'Knowledge':
                self::setDKnowledge();
                $Knowledge = (self::$dKnowledge->Select(array('knowledgeId' => (int)$array['dp']), 'byKnowledgeId'))[0];
                return '
                    <form action="" method="post" class="form-group col-12 p-0 m-0" autocomplete="on" enctype="multipart/form-data">
                        <div class="form-group col p-0">
                            <div class="col-12 row">'
                                .sForm::Input(array('origo' => $array['origo'], 'data' => 'userId', 'desc' => '', 'value' => $GLOBALS['sessionId'], 'type' => 'hidden'))
                                .sForm::Input(array('origo' => $array['origo'], 'data' => 'classId', 'desc' => '', 'value' => self::$dKnowledge->Class_Id(), 'type' => 'hidden'))
                                .sForm::Generate(array('constData' => self::UPLOAD_KNOWLEDGE, 'staticData' => array('origo' => $array['origo'], 'tag' => 'Edit'), 'valueData' => $Knowledge))
                            .'</div>
                        </div>
                        <div class="form-group">
                            <div class="col-12 row">
                                <input type="submit" class="btn btn-lg btn-success col-12 col-md-6 ml-auto" value="Mentés" id="'.$array['origo'].'-button">
                            </div>
                        </div>
                    </form>';
                break;
			case 'Device':
				self::setDHardware();
				$Hardware = (self::$dHardware->Select(array('hardwareId' => (int)$array['dp']), 'byHardwareId'))[0];
				return '
					<form action="" method="post" class="form-group col-12 p-0 m-0" autocomplete="on" enctype="multipart/form-data">
						<div class="form-group col p-0">
							<div class="col-12 row">'
								.sForm::Input(array('origo' => $array['origo'],'data' => 'userId','desc' => '','value' => $GLOBALS['sessionId'],'type' => 'hidden'))
								.sForm::Input(array('origo' => $array['origo'],'data' => 'classId','desc' => '','value' => self::$dHardware->Class_Id(),'type' => 'hidden'))
								.sForm::Generate(array('constData' => self::UPLOAD_HARDWARE,'staticData' => array('origo' => $array['origo'],'tag' => 'Edit'),'valueData' => $Hardware))
							.'</div>
						</div>
						<div class="form-group">
							<div class="col-12 row">
								<input type="submit" class="btn btn-lg btn-success col-12 col-md-6 ml-auto" value="Mentés" id="'.$array['origo'].'-button">
							</div>
						</div>
					</form>';
				break;
	    }
    }
/**
* Deletes selected Passtorage element
*
* @param $array array
*
* @return string
*
* @author Liszi Dániel
*/
    public static function Delete(array $array): string
    {
	    switch($array['y']){
	        case 'Passtorage':
                self::setDPasstorage();
                return
                    '<h4>'.(
                        (self::$dPasstorage->Delete(
                            array(
                                'passtorageId' => (int)$array['dp']
                                ,'userId' => $GLOBALS['sessionId']
                            )
                        ))
                            ? sTranslate::ACTION['Success']['content']
                            : sTranslate::ACTION['Fail']['content']
                    ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
                break;
            case 'Access':
                self::setDAccess();
                return
                    '<h4>'.(
                        (self::$dAccess->Delete(
                            array(
                                'accessId' => (int)$array['dp']
                                ,'userId' => $GLOBALS['sessionId']
                            )
                        ))
                            ? sTranslate::ACTION['Success']['content']
                            : sTranslate::ACTION['Fail']['content']
                    ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
                break;
            case 'Knowledge':
                self::setDKnowledge();
                return
                    '<div class="text-center justification-centered"><h4>'.(
                        (self::$dKnowledge->Delete(
                            array(
                                'knowledgeId' => (int)$array['dp']
                                ,'userId' => $GLOBALS['sessionId']
                            )
                        ))
                            ? sTranslate::ACTION['Success']['content']
                            : sTranslate::ACTION['Fail']['content']
                    ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
                break;
			case 'Device':
				self::setDHardware();
				return
					'<h4>'.(
						(self::$dHardware->Delete(
							array(
								'hardwareId' => (int)$array['dp']
								,'userId' => $GLOBALS['sessionId']
							)
						))
							? sTranslate::ACTION['Success']['content']
							: sTranslate::ACTION['Fail']['content']
                    ).'</h4>'.sForm::Spinner(self::RETURN_PATH[$array['y']]);
				break;
	    }
    }
}