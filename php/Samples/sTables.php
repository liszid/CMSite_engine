<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{
    Log,
    Check,
    Valid
};

/**
 * @update 2024.12.11
 * @author Liszi Dániel
 */

class sTables implements
    sTables\ADMIN
    ,sTables\USERS
    ,sTables\STORAGE
{
    /** @var const ACTIONS Array of actions */
    const ACTIONS = ['Edit', 'View', 'Delete', 'Reset', 'Upload'];
    /** @var const ENABLED_ACTIONS Array of enabled action by default */
    const ENABLED_ACTIONS = ['View'];

    /**
     * Displays Table using constants as visible data, and all others are invisible but searchable
     *
     * @param array $array
     * @param string $type
     * @return string
     * @author Liszi Dániel
     */
    public static function Prompt(array $array, string $type): string
    {
        $constant = constant('self::' . $type);
        return (!empty($constant)) ? self::Generate($array, $constant) : '';
    }

    /**
     * Generates Table using both external and constant data
     *
     * @param array $array
     * @param array $data
     * @return string
     * @author Liszi Dániel
     */
    private static function Generate(array $array, array $data): string
    {
        $selectedKeys = [];
        $returnString = '<table id="' . $data['tableId'] . '" class="table table-striped display responsive tableBeautify bg-'.$GLOBALS['Site']['Style']['Text']['Header'].'" style="width:100%">
            <thead><tr>';

        foreach ($data['data'] as $key => $value) {
            $thTooltip = isset($value['tooltip']) && Valid::vString($value['tooltip'])
                ? "data-toggle='tooltip' data-placement='top' title='" . $value['tooltip'] . "'" : '';
            $thClass = $key === array_key_first($data['data']) ? 'never' : 'no-sort';
            $returnString .= '<th class="' . $thClass . '" ' . $thTooltip . '><center>' . $value['text'] . '</center></th>';
        }

        if (!empty($data['button'])) {
            $returnString .= '<th class="all no-sort"></th>';
        }

        if (!empty($array)) {
            $diffKeys = array_diff(array_keys($array[0]), array_keys($data['data']));
            foreach ($diffKeys as $key) {
                if (!is_numeric($key)) {
                    $selectedKeys[] = $key;
                    $returnString .= '<th class="never"><center>' . $key . '</center></th>';
                }
            }
        }
        $returnString .= '</tr></thead><tbody>';

        foreach ($array as $row) {
            $returnString .= '<tr>';
            foreach ($data['data'] as $key => $value) {
                $tdContent = ($key === 'userThumbnail') ? '<i class="fa fa-' . $row[$key] . '" aria-hidden="true"> </i>' : $row[$key];
                if (isset($value['action'])) {
                    $tdContent = '<a class="badge badge-primary" role="button" data-link="' . $data['tableRoot'] . '/' . $value['action'] . '" data-post="' . $row[array_key_first($data['data'])] . '" data-target="#modalBox">' . $tdContent . '</a>';
                }
                if (isset($value['link']) && !empty($row[$value['link']])) {
                    $tdContent = '<a class="badge badge-primary" role="button" href="' . $row[$value["link"]] . '" target="_blank" rel="noopener noreferrer">' . $tdContent . '</a>';
                }
                $returnString .= '<td class="align-baseline"><center>' . $tdContent . '</center></td>';
            }

            if (!empty($data['button'])) {
                $buttonData = '';
                foreach ($data['button'] as $b) {
                    $aTooltip = isset($b['tooltip']) && Valid::vString($b['tooltip'])
                        ? "data-toggle='tooltip' data-placement='top' title='" . $b['tooltip'] . "'" : '';
                    $aData = '<a class="btn btn-' . $b['color'] . '" role="button" data-link="' . $data['tableRoot'] . '/' . $b['action'] . '" data-post="' . $row[array_key_first($data['data'])] . '"' . (!isset($b['nonModal']) ? ' data-target="#modalBox"' : '') . ' ' . $aTooltip . '>';
                    $buttonPoints = 0;

                    $buttonPoints = (!in_array($b['action'], self::ACTIONS)) ? $buttonPoints - 50 : $buttonPoints;
                    $buttonPoints = (!$row["isDelete"]) ? $buttonPoints - 50 : $buttonPoints;
                    $buttonPoints = (!$_SESSION['User']['canAdministrative']) ? $buttonPoints : $buttonPoints + 25;
                    $buttonPoints = (isset($row['userId']) && $row['userId'] == $_SESSION['User']['userId']) ? $buttonPoints + 5 : $buttonPoints;
                    $buttonPoints = (isset($b['level']) && $b['level'] != 1) ? $buttonPoints : $buttonPoints + 1;
                    $buttonPoints = (!in_array($b['action'], self::ENABLED_ACTIONS)) ? $buttonPoints - 1 : $buttonPoints + 50;
                    $buttonPoints = (isset($row['userId']) && $row['userId'] == $_SESSION['User']['userId'] && $_SESSION['User'][$data['tableRole']] >= $b['level']) ? $buttonPoints + 1 : $buttonPoints;

                    if ($buttonPoints <= 0) {
                        $aData = '<a class="btn btn-secondary" role="button">';
                    }
                    $buttonData .= $aData . '<i class="fa fa-' . $b['fa'] . '" aria-hidden="true"></i></a>';
                }
                $returnString .= '<td class="align-baseline"><div class="btn-group" role="group">' . $buttonData . '</div></td>';
            }

            foreach ($selectedKeys as $key) {
                $returnString .= '<td class="align-baseline"><center>' . $row[$key] . '</center></td>';
            }

            $returnString .= '</tr>';
        }

        $returnString .= '</tbody><tfoot><tr>';

        foreach ($data['data'] as $key => $value) {
            $thTooltip = isset($value['tooltip']) && Valid::vString($value['tooltip'])
                ? "data-toggle='tooltip' data-placement='top' title='" . $value['tooltip'] . "'" : '';
            $returnString .= '<th ' . $thTooltip . '><center>' . $value['text'] . '</center></th>';
        }

        if (!empty($data['button'])) {
            $returnString .= '<th></th>';
        }

        foreach ($selectedKeys as $key) {
            $returnString .= '<th class="hidden-column"><center>' . $key . '</center></th>';
        }

        $returnString .= '</tr></tfoot></table>';

        return $returnString;
    }
}
