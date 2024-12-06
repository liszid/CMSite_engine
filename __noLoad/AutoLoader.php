<?php

declare(strict_types=1);

spl_autoload_register('AutoLoader');

use Load\_IncludeOnce;

_IncludeOnce::Directory(array('dir' => $_SERVER['DOCUMENT_ROOT'].'/__noLoad/global_params/', 'type' => 'php', 'mode' => 'e'));

function AutoLoader($className)
{
    $pathRoot = $_SERVER['DOCUMENT_ROOT'].'/php/';

    if (empty($className) || !is_string($className)) {
        return false;
    }

    $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

    $directory = scandir($pathRoot);
    $files = [];
    foreach ($directory as $fileName) {
        if ($fileName !== "." && $fileName !== ".." && is_dir($pathRoot . $fileName)) {
            $files[] = $fileName;
        }
    }

    if (file_exists($className . '.php')) {
        include_once($className . '.php');
    } elseif(file_exists($pathRoot . $className . '.php')) {
        include_once($pathRoot . $className . '.php');
    } else {
        foreach ($files as $fileName) {
            if (file_exists(DIR_ . $fileName . "/" . $className . '.php')) {
                include_once(DIR_ . $fileName . "/" . $className . '.php');
            }
        }
    }

    return true;
}
