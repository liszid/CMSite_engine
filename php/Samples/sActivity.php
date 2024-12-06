<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Data\{
    dCombined
    ,dCalendar
    ,dCompany
    ,dCompany_Site
    ,dAccess
    ,dPasstorage
    ,dKnowledge
};

class sActivity
{

    
/**
 * Generates event notes from Calendar
 *
 * @param $userId int
 *
 * @return array
 *
 * @author Liszi Dániel
 */
    public static function CalendarEvents (int $userId = 0): string
    {
        $dCalendar = new dCalendar();
        $Calendar = $dCalendar->Select(array("userId" => $userId), 'byUserId');
        usort($Calendar, fn($a, $b) => $a['eventStartDate'] <=> $b['eventStartDate']);
        $calendarEvents = '<div class="timeline">';
        $iterationCount = 0;
        foreach ($Calendar as $value){
            if($iterationCount < 4) {
                $Start = new \DateTime($value['eventStartDate']);
                $value['eventEndDate'] = (empty($value['eventEndDate']) || $value['eventEndDate'] < $value['eventStartDate'] )?$value['eventStartDate']:$value['eventEndDate'];
                $End = new \DateTime($value['eventEndDate']);
                $Now = new \DateTime('now');
                $Diff1 = $Now->diff($Start);
                $Diff2 = $Now->diff($End);
                
                if ($Diff1->format('%R%a') >= 0 || $Diff2->format('%R%a') >= 0 ) {
                    $calendarEvents .= '
                        <div class="timeline-container timeline-container-left">
                            <div class="timeline-container-content">
                                <strong>'.$value['eventTitle'].'</strong> <br />
                                '.$value['eventDescription'].'<br />
                                <strong>Kezdés:</strong> '.date("Y. m. d. (D)", strtotime($value['eventStartDate'])).'<br />
                                <strong>Vége:</strong> '.date("Y. m. d. (D)", strtotime($value['eventEndDate'])).'
                            </div>
                        </div>';
                    $iterationCount++;
                }
            }
        }
        $calendarEvents .= '</div>';
        return $calendarEvents;
    }
    
/**
 * Returns pieChart values for generation
 *
 * @param $userId int
 *
 * @return array
 *
 * @author Liszi Dániel
 */
    public static function PieChart (int $userId = 0): array
    {
        $dCompany = new dCompany();
        $dCompany_Site = new dCompany_Site();
        $dAccess = new dAccess();
        $dPasstorage = new dPasstorage();
        $dKnowledge = new dKnowledge();
        $totalActivity = count($dKnowledge->Select(array("userId" => $userId), "byUserId")) + count($dAccess->Select(array("userId" => $userId), "byUserId")) + count($dPasstorage->Select(array("userId" => $userId), "byUserId")) + count($dCompany->Select(array("userId" => $userId), "byUserId")) + count($dCompany_Site->Select(array("userId" => $userId), "byUserId"));
        return array(
            array('label'=>'Tudáscikkek', 'y' => (count($dKnowledge->Select(array("userId" => $userId), "byUserId")) / $totalActivity * 100))
            , array('label'=>'Hozzáférések', 'y'  => (count($dAccess->Select(array("userId" => $userId), "byUserId")) / $totalActivity * 100))
            , array('label'=>'Széfek', 'y'  => (count($dPasstorage->Select(array("userId" => $userId), "byUserId")) / $totalActivity * 100))
            , array('label'=>'Ügyfelek', 'y'  => (count($dCompany->Select(array("userId" => $userId), "byUserId")) + count($dCompany_Site->Select(array("userId" => $userId), "byUserId")) / $totalActivity * 100))
        );
    }
/**
 * Returns activity modul, or errorLog
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Prompt (array $array = array()): string
    {
        if (isset($array)) {
            $prompt = '';
            $elementArray = array(
                array("desc" => "Tudáscikk", "data" => $array['actKnowledges'])
                ,array("desc" => "Hozzáférés", "data" => $array['actAccesses'])
                ,array("desc" => "Széfek", "data" => $array['actPasstorages'])
                ,array("desc" => "Ügyfél", "data" => $array['actCompanies'])
            );
            foreach ($elementArray as $e) {
                $prompt .= self::promptActivity($e);
            }
            return '
                <ul class="list-group">
                    '.$prompt.'
                </ul>';
        } else {
            return '';
        }
    }
/**
 * Used to display user activity elements
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	public static function promptActivity(array $array): string
    {
        return '
            <li class="list-group-item text-right">
                <span class="pull-left"><strong>'.$array['desc'].'</strong></span> '.$array['data'].'
            </li>
        ';
    }
/**
 * Returns activity array
 *
 * @param $userId int
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Activity(int $userId = 0): array
    {
        $dCompany = new dCompany();
        $dCompany_Site = new dCompany_Site();
        $dAccess = new dAccess();
        $dPasstorage = new dPasstorage();
        $dKnowledge = new dKnowledge();
        return array(
            'actKnowledges' => count($dKnowledge->Select(array("userId" => $userId), "byUserId"))
            ,'actAccesses' => count($dAccess->Select(array("userId" => $userId), "byUserId"))
            ,'actPasstorages' => count($dPasstorage->Select(array("userId" => $userId), "byUserId"))
            ,'actCompanies' => count($dCompany->Select(array("userId" => $userId), "byUserId")) + count($dCompany_Site->Select(array("userId" => $userId), "byUserId"))
        );
    }

/**
 * Sets UserSession array
 *
 * @param $array array
 *
 * @author Liszi Dániel
 */
    public static function Set(array $array = array()): void
    {
        if (Valid::vArray($array)) {
            if (isset($_SESSION['User'])) {
                unset($_SESSION['User']);
            }
            $_SESSION['User'] = $array;
            $_SESSION['User']['Activity'] = self::Activity((int)$array['userId']);
        }
    }
}
