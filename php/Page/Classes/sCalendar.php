<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Data\{
    dCalendar
};

use Samples\{
    sCard
    ,sTables
    ,sTranslate
    ,sForm
    ,sFrame
};

class sCalendar
{
/** @var object $dCombined dCombined class object */
    protected static $dCalendar;
/** @var const CALENDAR Class constant for dCalendar form elements */
    const CALENDAR = array(
        array('data' => 'eventTitle', 'desc' => 'Esemény neve', 'type' => 'text', 'tags' => 'Add,View,Edit', 'must-fill' => true)
        ,array('data' => 'eventDescription', 'desc' => 'Esemény leírása', 'type' => 'text', 'tags' => 'Add,View,Edit')
        ,array('data' => 'eventStartDate', 'desc' => 'Kezdete', 'type' => 'date', 'tags' => 'Add,View,Edit', 'must-fill' => true)
        ,array('data' => 'eventEndDate', 'desc' => 'Vége', 'type' => 'date', 'tags' => 'Add,View,Edit')
//      ,array('data' => 'eventColor', 'desc' => 'Jelölő szín', 'type' => 'text', 'tags' => 'Add,View,Edit')
//      ,array('data' => 'eventEveryYear', 'desc' => 'Évente ismétlődik', 'type' => 'text', 'tags' => 'Add,View,Edit')
    );
/** @var const TYPES Used for getting page specific variables, like form element IDs, form elements, tables */
    const TYPES = array(
        "Calendar" => array(
            "origo" => 'usrCalendar'
            ,"defaultData" => self::CALENDAR
			,"dbTableId" => 'eventId'
        )
	);
/**
 * Sets the class variable : dCalendar
 *
 * @author Liszi Dániel
 */
    protected static function setDCalendar()
    {
        self::$dCalendar = new dCalendar();
    }
/**
 * Used for events indicated by users
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	public static function Action(array $array): string
	{
		$array = array_merge($array, self::TYPES[$array['y']]);
		$array['origo'] .= $array['z'];
		$array['returnPath'] = array('x' => 'Plans', 'y' => 'Calendar');
		$returnContent = self::{$array['z']}($array);
		
		if (Valid::vString($returnContent)) {
			$returnContent = '<div class="text-center justification-centered">'.$returnContent.'</div>';
		}
		
		return $returnContent;
	}
/**
 * Calendar page display
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Calendar(array $array): string
    {
        self::setDCalendar();
        $returnString = '';
        $Calendar = self::$dCalendar->Select($_SESSION['User'], 'byUserId');
        $Events = array();
        foreach ($Calendar as $index =>$i ){
            $Start = new \DateTime($i['eventStartDate']);
            $i['eventEndDate'] = (empty($i['eventEndDate']) || $i['eventEndDate'] < $i['eventStartDate'] )?$i['eventStartDate']:$i['eventEndDate'];
            $End = new \DateTime($i['eventEndDate']);
            $Diff = $Start->diff($End)->d;
            if ($Diff > 0){
                for ($j = 0; $j <= $Diff; $j++) {
                    $Events[] = array(
                        'id' => $i['eventId']
                        ,'name' => $i['eventTitle']
                        ,'description' => $i['eventDescription']
                        ,'date' => date('m/d/Y', strtotime($i['eventStartDate'] . "+".$j." day"))
                        ,'type' => 'event'
                        ,'color' => $i['eventColor']
                        ,'everyYear' => $i['eventEveryYear']
                    );
                }
            } else {
                $Events[] = array(
                    'id' => $i['eventId']
                    ,'name' => $i['eventTitle']
                    ,'description' => $i['eventDescription']
                    ,'date' => date('m/d/Y', strtotime($i['eventStartDate']))
                    ,'type' => 'event'
                    ,'color' => $i['eventColor']
                    ,'everyYear' => $i['eventEveryYear']
                );
            }
        }
        
        if (isset($array['path'])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array['path']));
        }
        
        $returnString .= '<div class="">
            <div class="log-content">
                <div class="--noshadow" id="calendar"></div>
            </div>
            <div id="json" style="display:none">
            '.json_encode($Events).'
            </div>
        </div>';
        
        return $returnString;
    }
    
/**
 * Returns Adding form
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Add(array $array): string
    {
        self::setDCalendar();
        $wClass = self::$dCalendar;
        
        if (! isset($array['Save'])) {
            return '
                <form method="post" class="form-group col-12 p-0 m-0" autocomplete="on">
                    <div class="form-group col p-0">
                        <div class="col-12 row">'
                            .sForm::Input(array('origo' => $array['origo'],'data' => 'userId','desc' => '','value' => $GLOBALS['sessionId'],'type' => 'hidden'))
                            .sForm::Generate(array('constData' => $array['defaultData'],'staticData' => array('origo' => $array['origo'],'tag' => 'Add')))
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
                    (
                        $wClass->Insert($array)
                    )
                    ? sTranslate::ACTION['Success']['content']
                    : sTranslate::ACTION['Fail']['content']
                ).'</h4>'.sForm::Spinner($array['returnPath']);
        }
    }
    
/**
 * Fires Delete action
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Delete(array $array): string
    {
        self::setDCalendar();

        $wClass = self::$dCalendar;

        return
            '<h4>'.(
                (
                    $wClass->Delete(
                        array(
                            $array['dbTableId'] => (int)$array['dp']
                            ,'userId' => $GLOBALS['sessionId']
                        )
                    )
                )
                ? sTranslate::ACTION['Success']['content']
                : sTranslate::ACTION['Fail']['content']
            ).'</h4>'.sForm::Spinner($array['returnPath']);
        }

}