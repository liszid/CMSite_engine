<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{Log, Check, Valid};

class sTables implements sTables\ADMIN, sTables\USERS, sTables\STORAGE, sTables\KANBAN
{
    const ACTIONS = ["Edit", "View", "Delete", "Reset", "Upload"];
    const ENABLED_ACTIONS = ["View"];

    public static function Prompt(array $array, string $type): string
    {
        $constant = constant("self::" . $type);
        return !empty($constant) ? self::Generate($array, $constant) : "";
    }

    private static function Generate(array $array, array $data): string
    {
        if (!empty($data["sortKey"])) {
            $sortColumn = $data["sortKey"][0]; // Az oszlop neve
            $sortOrder = $data["sortKey"][1]; // "asc" vagy "desc"

            if (array_key_exists($sortColumn, $data["data"])) {
                usort($array, function ($a, $b) use ($sortColumn, $sortOrder) {
                    // Ellenőrzés: Ha számértékekkel dolgozunk, akkor numerikus összehasonlítást végzünk
                    if (is_numeric($a[$sortColumn]) && is_numeric($b[$sortColumn])) {
                        return $sortOrder === "asc" ? $a[$sortColumn] - $b[$sortColumn] : $b[$sortColumn] - $a[$sortColumn];
                    }
                    // Ha nem szám, akkor mehet a normál strcmp()
                    return $sortOrder === "asc" ? strcmp((string) $a[$sortColumn], (string) $b[$sortColumn]) : strcmp((string) $b[$sortColumn], (string) $a[$sortColumn]);
                });
            }
        }


        $selectedKeys = [];
        $returnString =
            '<table id="' . $data["tableId"] . '" 
            class="table table-striped display responsive tableBeautify bg-' .
            $GLOBALS["Site"]["Style"]["Text"]["Header"] . '"
            style="width:100%" 
            data-config=\'' . json_encode([
                "sortKey" => isset($data["sortKey"]) ? [
                    array_search($data["sortKey"][0], array_keys($data["data"])), 
                    $data["sortKey"][1]
                ] : null,
                "hiddenColumns" => array_keys(array_filter($data["data"], fn($col) => isset($col["never"]) && $col["never"] === true))
            ]) . '\'>
            <thead><tr>';


        foreach ($data["data"] as $key => $value) {
            $thTooltip =
                isset($value["tooltip"]) && Valid::vString($value["tooltip"])
                    ? "data-toggle='tooltip' data-placement='top' title='" . $value["tooltip"] . "'"
                    : "";
            $thClass = isset($value["never"]) && $value["never"] === "true" ? "never" : "no-sort";
            $returnString .=
                '<th class="' . $thClass . '" ' . $thTooltip . "><center>" . $value["text"] . "</center></th>";
        }

        if (!empty($data["button"])) {
            $returnString .= '<th class="all no-sort"></th>';
        }

        if (!empty($array)) {
            $diffKeys = array_diff(array_keys($array[0]), array_keys($data["data"]));
            foreach ($diffKeys as $key) {
                if (!is_numeric($key)) {
                    $selectedKeys[] = $key;
                    $returnString .= '<th class="never"><center>' . $key . "</center></th>";
                }
            }
        }
        $returnString .= "</tr></thead><tbody>";

        foreach ($array as $row) {
            $returnString .= "<tr>";
            foreach ($data["data"] as $key => $value) {
                $tdContent =
                    $key === "userThumbnail"
                        ? '<i class="fa fa-' . $row[$key] . '" aria-hidden="true"> </i>'
                        : $row[$key];
                if (isset($value["action"])) {
                    $tdContent =
                        '<a class="badge badge-primary" role="button" data-link="' .
                        $data["tableRoot"] .
                        "/" .
                        $value["action"] .
                        '" data-post="' .
                        $row[array_key_first($data["data"])] .
                        '" data-target="#modalBox">' .
                        $tdContent .
                        "</a>";
                }
                if (isset($value["link"]) && !empty($row[$value["link"]])) {
                    $tdContent =
                        '<a class="badge badge-primary" role="button" href="' .
                        $row[$value["link"]] .
                        '" target="_blank" rel="noopener noreferrer">' .
                        $tdContent .
                        "</a>";
                }
                $returnString .= '<td class="align-baseline">' . $tdContent . "</td>";
            }

            if (!empty($data["button"])) {
                $buttonData = "";
                foreach ($data["button"] as $b) {
                    $aTooltip =
                        isset($b["tooltip"]) && Valid::vString($b["tooltip"])
                            ? "data-toggle='tooltip' data-placement='top' title='" . $b["tooltip"] . "'"
                            : "";
                    $aData =
                        '<a class="btn btn-' .
                        $b["color"] .
                        '" role="button" data-link="' .
                        $data["tableRoot"] .
                        "/" .
                        $b["action"] .
                        '" data-post="' .
                        $row[array_key_first($data["data"])] .
                        '"' .
                        (!isset($b["nonModal"]) ? ' data-target="#modalBox"' : "") .
                        " " .
                        $aTooltip .
                        ">";
                    $buttonPoints = 0;

                    $buttonPoints = !in_array($b["action"], self::ACTIONS) ? $buttonPoints - 50 : $buttonPoints;
                    $buttonPoints = !$row["isDelete"] ? $buttonPoints - 50 : $buttonPoints;
                    $buttonPoints = !$_SESSION["User"]["canAdministrative"] ? $buttonPoints : $buttonPoints + 25;
                    $buttonPoints =
                        isset($row["userId"]) && $row["userId"] == $_SESSION["User"]["userId"]
                            ? $buttonPoints + 5
                            : $buttonPoints;
                    $buttonPoints = isset($b["level"]) && $b["level"] != 1 ? $buttonPoints : $buttonPoints + 1;
                    $buttonPoints = !in_array($b["action"], self::ENABLED_ACTIONS)
                        ? $buttonPoints - 1
                        : $buttonPoints + 50;
                    $buttonPoints =
                        isset($row["userId"]) &&
                        $row["userId"] == $_SESSION["User"]["userId"] &&
                        $_SESSION["User"][$data["tableRole"]] >= $b["level"]
                            ? $buttonPoints + 1
                            : $buttonPoints;

                    if ($buttonPoints <= 0) {
                        $aData = '<a class="btn btn-secondary" role="button">';
                    }
                    $buttonData .= $aData . '<i class="fa fa-' . $b["fa"] . '" aria-hidden="true"></i></a>';
                }
                $returnString .=
                    '<td class="align-baseline"><div class="btn-group" role="group" style="float:right;">' . $buttonData . "</div></td>";
            }

            foreach ($selectedKeys as $key) {
                $returnString .= '<td class="align-baseline">' . $row[$key] . "</td>";
            }

            $returnString .= "</tr>";
        }

        $returnString .= "</tbody><tfoot><tr>";

        foreach ($data["data"] as $key => $value) {
            $thTooltip =
                isset($value["tooltip"]) && Valid::vString($value["tooltip"])
                    ? "data-toggle='tooltip' data-placement='top' title='" . $value["tooltip"] . "'"
                    : "";
            $returnString .= "<th " . $thTooltip . "><center>" . $value["text"] . "</center></th>";
        }

        if (!empty($data["button"])) {
            $returnString .= "<th></th>";
        }

        foreach ($selectedKeys as $key) {
            $returnString .= '<th class="hidden-column"><center>' . $key . "</center></th>";
        }

        $returnString .= "</tr></tfoot></table>";

        return $returnString;
    }
}
?>
