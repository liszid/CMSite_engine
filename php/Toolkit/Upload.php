<?php

declare(strict_types=1);

namespace Toolkit;

class Upload
{
/** @var object $wClass Class objects are going into it */
    private static $wClass;
/**
 * Handles file upload by using dynamic class selection and parameter handling
 *
 * @return bool
 *
 * @author Liszi Dániel
 * @copyright 2020 -
 */
    public static function Upload(): bool
    {
        if (isset($_POST['classId'])) {
/** @var object $File Anchor object for $_FILES['fileToUpload'] */
            $File = $_FILES['fileToUpload'];
/** @var string $fTarget Target location of the uploaded file*/
            $fTarget = $GLOBALS['Directory']['Upload'] . md5(date("YmdHis").basename($File['name']));
/** @var string $fSource Source location of the uploaded file*/
            $fSource = $File['tmp_name'];
/** @var string $className Stores the classname for the $wClass object to be used */
            $className = $GLOBALS['Upload'][$_POST['classId']]['className'];
            if (
                file_exists($fTarget)
                || $_FILES["fileToUpload"]["size"] > 50000000
            ){
                return false;
            } else {
                self::$wClass = new $className();

                $paramArray = array();

                foreach ($GLOBALS['Upload'][$_POST['classId']] as $key => $item) {
                    if(isset($_POST[$key])) {
                        $paramArray[$item] = $_POST[$key];
                    } elseif (isset($File[$key])) {
                        $paramArray[$item] = $File[$key];
                    } elseif (! strcmp($key, 'generated_file_path')){
                        $paramArray[$item] = '/'.$fTarget;
                    }
                }

                if (move_uploaded_file($fSource, $fTarget)) {
                    return self::$wClass->Insert($paramArray);
                } else {
                    return false;
                }
            }
        }
    }
}
