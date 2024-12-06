<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class sTables implements
    sTables\ACCESS
    ,sTables\ADMIN
    ,sTables\COMPANY
    ,sTables\PASSTORAGE
    ,sTables\USERS
    ,sTables\KNOWLEDGE
    ,sTables\HARDWARE
{
/** @var const ACTIONS Array of actions */
    const ACTIONS = array('Edit', 'View', 'Delete', 'Reset', 'Filter2Company', 'Upload');
/** @var const ENABLED_ACTIONS Array of enabled action by default */
    const ENABLED_ACTIONS = array('View');

/**
 * Displays Table using constants as visible data, and all others are invisible but searchable
 *
 * @param $array array
 * @param $type string
 *
 * @return string
 *
 * @author Liszi Dániel
 */

   public static function Prompt(array $array, string $type): string
   {
   	return (
			(
				! empty(constant('self::'.$type))
			)
			? self::Generate($array, constant('self::'.$type))
			: ''
		);
	}

/**
 * Generates Table using both external and constant data
 *
 * @param $array array
 * @param $data array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    private static function Generate(array $array, array $data): string
    {
        $selectedKeys = array();
        $returnString = '
            <table id="'.$data['tableId'].'" class="table table-striped display responsive" style="width:100%"><thead><tr>';

        foreach ($data['data'] as $key => $value) {
            $thTooltip = (isset($value['tooltip']) && Valid::vString($value['tooltip'])) ? "data-toggle='tooltip' data-placement='top' title='".$value['tooltip']."'" : "";
            $thClass = ((strcmp($key, array_key_first($data['data'])) === 0)? 'never': 'no-sort');
            $returnString .= '<th class="'.$thClass.'" '.$thTooltip.'><center>'.$value['text'].'</center></th>';
        }

        if (count($data['button']) > 0) {
				$returnString .= '<th class="all no-sort"></th>';
        }

        if (count($array) > 0) {
            $diffKeys = array_diff(array_keys($array[0]), array_keys($data['data']));
            foreach ($diffKeys as $i) {
                if (! is_numeric($i)) {
                    $selectedKeys[] = $i;
                    $returnString .= '<th class="never"><center>'.$i.'</center></th>';
                }
            }

        }
        $returnString .= '</tr></thead><tbody>';

        foreach ($array as $i) {
            $returnString .= '<tr>';

            foreach ($data['data'] as $key => $value) {
                $tdTooltip = '';
                $tdContent = (strcmp($key, 'userThumbnail'))? $i[$key] : '<i class="fa fa-'.$i[$key].'" aria-hidden="true"> </i>';
                if (isset($value['action'])) {
                    $tdAData = '<a class="badge badge-primary" role="button" data-link="'.$data['tableRoot'].'/'.$value['action'].'" data-post="'.$i[array_key_first($data['data'])].'" data-target="#modalBox">';
                    $tdContent = $tdAData . $tdContent . '</a>';
                }
                if (isset($value['link']) && !empty($i[$value['link']])) {
                    $tdAData = '<a class="badge badge-primary" role="button" href="'.$i[$value["link"]].'" target="_blank" rel="noopener noreferrer">';
                    $tdContent = $tdAData . $tdContent . '</a>';
                }
                $returnString .= '<td class="align-baseline" '.$tdTooltip.'><center>'.$tdContent.'</center></td>';
            }

				if (count($data['button']) > 0) {
					$buttonData = '';
					foreach ($data['button'] as $b) {
						$aTooltip = (isset($b['tooltip']) && Valid::vString($b['tooltip'])) ? "data-toggle='tooltip' data-placement='top' title='".$b['tooltip']."'" : "";
						$aData = '<a class="btn btn-'.$b['color'].'" role="button" data-link="'.$data['tableRoot'].'/'.$b['action'].'" data-post="'.$i[array_key_first($data['data'])].'"'.(! isset($b['nonModal'])?' data-target="#modalBox"':'').' '.$aTooltip.'>';
						
						$buttonPoints = 0;
					
						$buttonPoints = (! in_array($b['action'], self::ACTIONS))? $buttonPoints - 50 : $buttonPoints; //instant disable
						$buttonPoints = (! $i["isDelete"])? $buttonPoints - 50 : $buttonPoints; //instant disable
						$buttonPoints = (! $_SESSION['User']['canAdministrative'])? $buttonPoints: $buttonPoints + 25;
						$buttonPoints = (isset($i['userId']) && $i['userId'] == $_SESSION['User']['userId'])? $buttonPoints + 5 : $buttonPoints;
						$buttonPoints = (isset($b['level']) && $b['level'] != 1)? $buttonPoints : $buttonPoints + 1;
						$buttonPoints = (! in_array($b['action'], self::ENABLED_ACTIONS))? $buttonPoints - 1: $buttonPoints + 50;
						$buttonPoints = (isset($i['userId']) && $i['userId'] == $_SESSION['User']['userId'] && $_SESSION['User'][$data['tableRole']] >= $b['level'])? $buttonPoints + 1: $buttonPoints ;
						
						if ( $buttonPoints <= 0 ) {
							$aData = '<a class="btn btn-secondary" role="button">';
						}
                    $buttonData .= $aData.'<i class="fa fa-'.$b['fa'].'" aria-hidden="true"></i></a>';
                }
                $returnString .= '<td class="align-baseline"><div class="btn-group" role="group">'.$buttonData.'</div></td>';
            }

            if (count($selectedKeys) > 0) {
                foreach ($selectedKeys as $k) {
                    $returnString .= '<td class="align-baseline"><center>'.$i[$k].'</center></td>';
                }
            }

            $returnString .= '</tr>';
        }

        $returnString .= '</tbody><tfoot><tr>';

        foreach ($data['data'] as $key => $value) {
            $thTooltip = (isset($value['tooltip']) && Valid::vString($value['tooltip'])) ? "data-toggle='tooltip' data-placement='top' title='".$value['tooltip']."'" : "";

            $returnString .= '<th '.$thTooltip.'><center>'.$value['text'].'</center></th>';
        }

        if (count($data['button']) > 0) {
				$returnString .= '<th></th>';
        }

        if (count($selectedKeys) > 0) {
            foreach ($selectedKeys as $i) {
                $returnString .= '<th class="hidden-column"><center>'.$i.'</center></th>';
            }

        }

        $returnString .= '</tr></tfoot></table>';

        return $returnString;
    }
}
