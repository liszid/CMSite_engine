<?php

declare(strict_types=1);

require_once 'AutoLoader.php';

use Samples\sSite;

use Toolkit\{
    Log
    ,Check
    ,Valid
    ,Upload
};

/**
 * Generates the structure of the site by creating new object of sSite class, after checking for upload action
 * @author Daniel Liszi
 * @createDate 11/04/2020
 * @lastmodifiedBy Daniel Liszi
 * @lastmodifiedDate 04/22/2025
 */

if (isset($_FILES) && !empty($_FILES)) {
    Upload::Upload();
}

$sSite = new sSite();
?>