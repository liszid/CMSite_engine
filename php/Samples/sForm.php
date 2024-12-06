<?php

declare(strict_types=1);

namespace Samples;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class sForm
{
/**
 * Generates a form of input elements using multiple arrays
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Generate(array $array): string
    {
        $returnString = '';

        $constData = (isset($array['constData'])) ? $array['constData'] : '';
        $staticData = (isset($array['staticData']))? $array['staticData'] : '';
        $valueData = (isset($array['valueData']))? $array['valueData'] : '';
        $selectData = (isset($array['selectData']))? $array['selectData'] : '';
        if ( is_array($constData) && is_array($staticData)) {
            foreach($constData as $i) {
                 if (stristr($i['tags'],$staticData['tag'])) {
                    $tempArray = array_merge($i, $staticData);
                    if (
                        (
                            ! strcmp($tempArray['tag'], 'Edit')
                            || ! strcmp($tempArray['tag'], 'View')
                        )
                        && is_array($valueData)
                    ) {
                        $tempArray['value'] = (isset($valueData[$tempArray['data']]))? $valueData[$tempArray['data']] : '';
                    } else {
                        if ( ! strcmp($tempArray['tag'], 'Add')) {
                            $tempArray['value'] = '';
                        }
                    }
                    if ( ! strcmp($tempArray['tag'], 'View')) {
                        $tempArray['disabled'] = true;
                    }
                    if (
                        (
                            ! strcmp($tempArray['type'],'select')
                            || ! strcmp($tempArray['type'],'layeredselect')
                            || ! strcmp($tempArray['type'],'selectpicker')
                        )
                        && is_array($selectData)
                    ) {
                        if (isset($selectData[$tempArray['data']])) {
                            $tempArray['select'] = $selectData[$tempArray['data']];
                        }
                    }
                    $returnString .= self::Input($tempArray);
                }
            }
        }
        return $returnString;
    }
/**
 * Adds input element on Editor
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Input(array $array): string
    {
        $returnString = $input = '';

        $array['inputId'] = (isset($array['origo']) && isset($array['data'])) ? $array['origo'].'-'.$array['data'] : '';
        $array['desc'] = Check::isDataSet($array, 'desc', '', '');
        $array['value'] = Check::isDataSet($array, 'value', '', '');
        $array['type'] = Check::isDataSet($array, 'type', '', '');
        $array['disabled'] = Check::isDataSet($array, 'disabled', 'readonly', '');
        $array['mustFill'] = (isset($array['must-fill'])) ? true: false;
        $array['input'] = '<input type="'.$array['type'].'" class="form-control col-12 p-0 m-0" id="'.$array['inputId'].'" name="'.$array['data'].'" value="'.$array['value'].'"'.$array['disabled'].(($array['mustFill'])?' data-must-fill="true"':'').'>';

        switch ($array['type']) {
            case 'select':
               $array['input'] = self::Input_Select($array);
               return self::Input_Default($array);
				case 'layeredselect':
					$array['input'] = self::Input_LayeredSelect($array);
               return self::Input_Default($array);
            case 'selectpicker':
               $array['input'] = self::Input_Selectpicker($array);
               return self::Input_Default($array);
            case 'hidden':
               return $array['input'];
            case 'file':
               return self::Input_File($array);
            case 'ckeditor':
               return self::Input_CKEditor($array);
            default:
               return self::Input_Default($array);
        }
    }
/**
 * Generates Select type input field
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Input_Select(array $array): string
	{
		$returnString = '<select class="custom-select" id="'.$array['inputId'].'"'.$array['disabled'].' data-live-search="true">';
		foreach ($array['select'] as $i) {
			$returnString .= '<option value="'.$i['id'].'"'.((! strcmp((string)$array['value'], (string)$i['id'])) ? ' selected' : '').'>'.$i['name'].'</option>';
		}
		$returnString .= '</select>';

		return $returnString;
	}
/**
 * Generates Layered Select type input field
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Input_LayeredSelect(array $array): string
	{
		$returnString = '<select class="form-control selectpicker" id="'.$array['inputId'].'"'.$array['disabled'].' data-live-search="true">';

		foreach ($array['select'] as $k => $v) {
			$returnString .= '<optgroup label="'.$k.'">';
			foreach($v as $i) {
				$returnString .= '<option value="'.$i['id'].'"'.((! strcmp((string)$array['value'], (string)$i['id'])) ? ' selected' : '').' data-tokens="'.strtolower($k.'-'.$i['name']).'">'.$i['name'].'</option>';
			}
			$returnString .= '</optgroup>';
		}
		$returnString .= '</select>';

		return $returnString;
	}
/**
 * Generates Selectpicker type input field
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Input_Selectpicker(array $array): string
	{
		$returnString = '<select class="form-control selectpicker" id="'.$array['inputId'].'"'.$array['disabled'].' data-live-search="true">';
		foreach ($array['select'] as $i) {
			$returnString .= '<option value="'.$i['id'].'"'.((! strcmp((string)$array['value'], (string)$i['id'])) ? ' selected' : '').' data-tokens="'.strtolower($i['name']).'">'.$i['name'].'</option>';
		}
		$returnString .= '</select>';

		return $returnString;
	}
/**
 * Generates CKEditor type input field
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Input_CKEditor(array $array): string
	{
		return (
			(empty($array['disabled']))
			? '
				<div class="form-group col-12 mx-0">
					<textarea class="ckeditor col-12" id="'.$array['inputId'].'">'.str_replace( '&', '&amp;', $array['value']).'</textarea>
				</div>'
			: '
				<div '.((isset($array['print']) && $array['print'])? 'id="printThis" ': '').'class="border-top border-bottom form-group col col-12 mx-0">
					'.$array['value'].'
				</div>'
		);
	}
/**
 * Generates File select type input field
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Input_File(array $array): string
	{
		return '<input type="'.$array['type'].'" class="form-control" id="'.$array['inputId'].'" name="'.$array['data'].'" value="">';
	}
/**
 * Generates Default input field
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
	private static function Input_Default(array $array): string
	{
		return '
			<div class="form-group row col-12 mx-0">
				<label for="'.$array['inputId'].'" class="col-sm-6 col-form-label text-left">'.$array['desc'].(($array['mustFill'] && ! isset($array['disabled']))?' *':'').'</label>
				<div class="col-sm-6 col-12 p-0 m-0">
					'.$array['input'].'
				</div>
			</div>';
	}
/**
 * Used to generate modal redirect spinner
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Spinner(array $array): string
    {
        if (Valid::vArray($array)) {
            $location = '';

            if (
                isset($array['x'])
                && ! empty($array['x'])
            ) {
                $location .= 'x='.$array['x'];
                if (
                    isset($array['y'])
                    && ! empty($array['y'])
                ) {
                    $location .= '&y='.$array['y'];
                    if (
                        isset($array['z'])
                        && ! empty($array['z'])
                    ) {
                        $location .= '&z='.$array['z'];
                    }
                }
            } else {
                $location .= 'x=Home';
            }

            return '
                <div class="col-12">
                    <div class="spinner-grow">
                        <img style="display:none;" src="'.$GLOBALS['Root']['Path'].'images/placeholder.png" alt="Loading Animation" onload="setTimeout( function(){ Instance.initElmnt(\''.$location.'\'); $(\'[data-dismiss=modal]\').trigger({ type: \'click\' }); '.((isset($array['reload']) && $array['reload'])? 'window.location.reload();' : '').' }, 750);">
                    </div>
                </div>';
        } else {
            return '';
        }
    }
/**
 * Used to generate "Add New" button
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
// sCard::Collapsible,
    public static function Add(array $array): string
    {
        if (isset($array['path'])) {
            return '
                <div class="ml-sm-auto">
                    <a class="col-12 btn btn-success" role="button" data-link="'.$array['path'].'/Add"'.(($array['addNonModal'] === true)?'':' data-post="0" data-toggle="modal" data-target="#modalBox"').'>
                        <i class="fa fa-'.$array['fa'].'" aria-hidden="true"></i>
                        <span><b>Új hozzáadása</b></span>
                    </a>
                </div>';
        } else {
            return '';
        }
    }
/**
 * Used to generate "Add New" button
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
 // sAdministrative::Tools
    public static function Button(array $array): string
    {
        if (isset($array['path'])) {
            return '
                <div class="ml-auto">
                    <a class="btn btn-'.$array['color'].'" role="button" data-link="'.$array['path'].'" data-post="'.((isset($array['dp']))?$array['dp']:'').'"'.((isset($array['nonModal']) && $array['nonModal'])?'':'" data-toggle="modal" data-target="#modalBox"').'>
                        <i class="fa fa-'.$array['fa'].'" aria-hidden="true"></i>
                        <span>'.$array['text'].'</span>
                    </a>
                </div>';
        } else {
            return '';
        }
    }
/**
 * Generates download form
 *
 * @param $array array
 *
 * @return string
 *
 * @author Liszi Dániel
 */
    public static function Download(array $array = array()): string
    {
        $wClass = new $array['wClass']();
        
        $Prompt_Head = '<div class="row col-12 form-group mx-0"><b>Letölthető tartalom</b></div>';
        $Prompt_Body = '';
        $Prompt_Foot = '<div class="form-group row border-top col-12 my-1 mx-0"><br/></div>';

        foreach($array['items'] as $f) {
    	    if (file_exists(substr_replace($GLOBALS['Root']['Site'] ,"", -1).$f[$array['filePath']])) {
            	$Prompt_Body .= '
            		<div class="form-group row col-12 my-1 mx-0">
            		    <a class="btn btn-primary col-12" href="/php/Download.php?fs='.$f[$array['filePath']].'&fn='.$f[$array['fileName']].'&ft='.$f[$array['fileType']].'"><!-- download="'.$f[$array['fileName']].'">-->
                			<table class="col-12">
                			    <tbody>
                    				<tr>
                    				    <th scope="row" class="w-50 d-flex align-items-start">
                    				        '.$f[$array['fileName']].'
                    				    </th>
                    				    <td class="w-25 float-start">
                    				        '.$f[$array['fileDate']].'
                    				    </td>
                    				    <td class="w-25 float-start">
                    				        '.round((int)$f[$array['fileSize']] / 1024, 2).' kB
                    				    </td>
                    				</tr>
                			    </tbody>
                			</table>
            		    </a>
            		</div>';
    	    } else {
        		if (isset($f[$array['fileId']])) {
        		    $wClass->Delete(array($array['fileId'] => (int)$f[$array['fileId']], 'userId' => $GLOBALS['sessionId']));
        		}
    	    }
        }

        if (! empty($Prompt_Body)) {
            return $Prompt_Head.$Prompt_Body.$Prompt_Foot;
        } else {
            return '';
        }
    }
}
