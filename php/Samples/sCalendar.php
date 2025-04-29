<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{Log, Check, Valid};

use Data\{dCalendar};

class sCalendar
{
    /**
     * Generates event notes from Calendar
     * @param $userId int
     * @return array
     * @author Liszi Dániel
     */
    public static function Events(int $userId = 0): string
    {
        $dCalendar = new dCalendar();
        $Calendar = $dCalendar->Select(["userId" => $userId], "byUserId");
        usort($Calendar, fn($a, $b) => $a["eventStartDate"] <=> $b["eventStartDate"]);
        $calendarEvents = '<div class="timeline">';
        $iterationCount = 0;
        foreach ($Calendar as $value) {
            if ($iterationCount < 4) {
                $Start = new \DateTime($value["eventStartDate"]);
                $value["eventEndDate"] =
                    empty($value["eventEndDate"]) || $value["eventEndDate"] < $value["eventStartDate"]
                        ? $value["eventStartDate"]
                        : $value["eventEndDate"];
                $End = new \DateTime($value["eventEndDate"]);
                $Now = new \DateTime("now");
                $Diff1 = $Now->diff($Start);
                $Diff2 = $Now->diff($End);

                if ($Diff1->format("%R%a") >= 0 || $Diff2->format("%R%a") >= 0) {
                    $calendarEvents .=
                        '
                        <div class="timeline-container timeline-container-left">
                            <div class="timeline-container-content">
                                <strong>' .
                        $value["eventTitle"] .
                        '</strong> <br />
                                ' .
                        $value["eventDescription"] .
                        '<br />
                                <strong>Kezdés:</strong> ' .
                        date("Y. m. d. (D)", strtotime($value["eventStartDate"])) .
                        '<br />
                                <strong>Vége:</strong> ' .
                        date("Y. m. d. (D)", strtotime($value["eventEndDate"])) .
                        '
                            </div>
                        </div>';
                    $iterationCount++;
                }
            }
        }
        $calendarEvents .= "</div>";
        return $calendarEvents;
    }
    
    /**
     * Calendar page display
     * @param $array array
     * @return string
     * @author Liszi Dániel
     */
    public static function Display(array $array): string
    {
        $dCalendar = new dCalendar();
        $returnString = "";
        $Calendar = $dCalendar->Select($_SESSION["User"], "byUserId");
        $Events = [];
        foreach ($Calendar as $index => $i) {
            $Start = new \DateTime($i["eventStartDate"]);
            $i["eventEndDate"] =
                empty($i["eventEndDate"]) || $i["eventEndDate"] < $i["eventStartDate"]
                    ? $i["eventStartDate"]
                    : $i["eventEndDate"];
            $End = new \DateTime($i["eventEndDate"]);
            $Diff = $Start->diff($End)->d;
            if ($Diff > 0) {
                for ($j = 0; $j <= $Diff; $j++) {
                    $Events[] = [
                        "id" => $i["eventId"],
                        "name" => $i["eventTitle"],
                        "description" => $i["eventDescription"],
                        "date" => date("m/d/Y", strtotime($i["eventStartDate"] . "+" . $j . " day")),
                        "type" => "event",
                        "color" => $i["eventColor"],
                        "everyYear" => $i["eventEveryYear"],
                    ];
                }
            } else {
                $Events[] = [
                    "id" => $i["eventId"],
                    "name" => $i["eventTitle"],
                    "description" => $i["eventDescription"],
                    "date" => date("m/d/Y", strtotime($i["eventStartDate"])),
                    "type" => "event",
                    "color" => $i["eventColor"],
                    "everyYear" => $i["eventEveryYear"],
                ];
            }
        }

        if (isset($array["path"])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array["path"]));
        }

        $returnString .=
            '<div class="">
            <div class="log-content">
                <div class="--noshadow" id="calendar"></div>
            </div>
            <div id="json" style="display:none">
            ' .
            json_encode($Events) .
            '
            </div>
        </div>';
        return $returnString;
    }
}
?>