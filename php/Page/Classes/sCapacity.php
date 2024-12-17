<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Data\{
    dCapacity
};

use Samples\{
    sCard
    ,sTables
    ,sTranslate
    ,sForm
    ,sFrame
};

class sCapacity
{
/** @var object $dHardware dHardware class object */
    protected static $dCapacity;
    
/** @var const RETURN_PATH Used to define Spinner return path */
    const RETURN_PATH=array(
        'Access' => array('x' => 'Capacity', 'y' => 'Capacity')
    );
/** @var const Insance Data form variables/elements */
    const FORMDATA = array(
        'Capacity' => array(
            array('data' => 'symid', 'desc' => '', 'type' => 'hidden', 'tags' => 'view')
            ,array('data' => 'accessUsername', 'desc' => 'Felhasználónév', 'type' => 'text', 'tags' => 'View')
            ,array('data' => 'accessPassword', 'desc' => 'Jelszó', 'type' => 'text', 'tags' => 'View')
    		,array('data' => 'accessLabel', 'desc' => 'Cimke', 'type' => 'text', 'tags' => 'View')
            ,array('data' => 'accessLink', 'desc' => 'Hivatkozás', 'type' => 'text', 'tags' => 'View')
            ,array('data' => 'passtorageId', 'desc' => 'Tároló', 'type' => 'layeredselect', 'tags' => 'View')
        )
    );
    
/** @var const TYPES Used for getting page specific variables, like form element IDs, form elements, tables */
    const TYPES = array(
        "Access" => array(
            "origo" => ''
            ,"tableQuery" => 'Capacity_Table'
            ,"tableName" => 'CAPACITY_CAPACITY'
        )
    );
/**
 * Sets the class object : dHardware
 *
 * @author Liszi Dániel
 */
    protected static function setDCapacity()
    {
        self::$dCapacity = new dCapacity();
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
 * @return string
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
 * @return string
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
	    }
    }
}