<?php

declare(strict_types=1);
/* 
    blue, indigo, purple,
    pink, red, orange, yellow,
    green, teal, cyan,
    white,
    gray, gray-10, gray-20, gray-30, gray-40, gray-50, gray-60, gray-70, gray-80, gray-90, gray-dark,
    primary, secondary, success, info, warning, danger, light, dark
*/
$GLOBALS['colorPatterns'] = array(
//original
    '0' => array(
        'BGColor' => array('Navbar_Top' => 'info' ,'Navbar_Side' => 'info' ,'Brand' => 'dark' ,'Body' => 'gray-10' ,'Card' => 'success' ,'Footer' => 'dark')
        ,'Text' => array('Navbar' => 'light' ,'Footer' => 'white-50' ,'Card' => array('Content' => 'success' ,'Header' => 'white'), 'Header' => 'white', 'Body' => 'white', 'Link' => 'white')
    )
//light
    ,'1' => array(
        'BGColor' => array('Navbar_Top' => 'gray-20' ,'Navbar_Side' => 'gray-10' ,'Brand' => 'light' ,'Body' => 'light' ,'Card' => 'gray-20' ,'Footer' => 'dark')
        ,'Text' => array('Navbar' => 'gray-70' ,'Footer' => 'white-50' ,'Card' => array('Content' => 'mute' ,'Header' => 'black'), 'Header' => 'gray-60', 'Body' => 'gray-70', 'Link' => 'gray-70')
    )
//dark
    ,'2' => array(
        'BGColor' => array('Navbar_Top' => 'dark' ,'Navbar_Side' => 'gray-70' ,'Brand' => 'dark' ,'Body' => 'gray-50' ,'Card' => 'dark' ,'Footer' => 'dark')
        ,'Text' => array('Navbar' => 'light' ,'Footer' => 'white' ,'Card' => array('Content' => 'white' ,'Header' => 'white'), 'Header' => 'gray-60', 'Body' => 'gray-70', 'Link' => 'light')
    )
//indigo
    ,'3' => array(
        'BGColor' => array('Navbar_Top' => 'indigo' ,'Navbar_Side' => 'purple' ,'Brand' => 'dark' ,'Body' => 'light' ,'Card' => 'purple' ,'Footer' => 'dark')
        ,'Text' => array('Navbar' => 'light' ,'Footer' => 'white-50' ,'Card' => array('Content' => 'purple' ,'Header' => 'white'), 'Header' => 'white', 'Body' => 'white', 'Link' => 'white')
    )

);