<?php

declare(strict_types=1);

namespace Samples\sTranslate\hu;

interface ROLE
{
const ROLE_CARD_COLOR = 'cyan';

const ROLE = array(
'canAdministrative' => array(
'color' => 'secondary'
,'header' => 'Available function'
,'respective' => 'Administrative'
,'short' => 'cA'
,'desc' => '<b>Administrative</b> permission'
,'select_type' => 'state'
)
,'mngUsers' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Administrative/Users'
,'short' => 'mU'
,'desc' => 'Manage <b>Users</b>'
,'select_type' => 'state'
)
,'mngGroups' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Administrative/Groups'
,'short' => 'mG'
,'desc' => 'Manage <b>Permissions</b>'
,'select_type' => 'state'
)
,'mngHuntgroups' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Administrative/Huntgroups'
,'short' => 'mHGG'
,'desc' => 'Manage <b>Groups</b>'
,'select_type' => 'state'
)
,'mngTools' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Expandable function'
,'respective' => 'Administrative/Tools'
,'short' => 'mT'
,'desc' => 'Manage <b>Administrative Tools</b>'
,'select_type' => 'state'
)
,'canUsers' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Users'
,'short' => 'cUs'
,'desc' => '<b>[Users]</b> permission'
,'select_type' => 'state'
)
,'canCalendar' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Calendar'
,'short' => 'cCal'
,'desc' => '<b>[Calendar]</b> permission'
,'select_type' => 'state'
)
,'canCompany' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Company'
,'short' => 'cC'
,'desc' => '<b>[Customers]</b> privilege'
,'select_type' => 'access'
)
,'canInformations' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Informations'
,'short' => 'cI'
,'desc' => '<b>[Informations]</b> permission'
,'select_type' => 'access'
)
,'canKnowledge' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Informations/Knowledge'
,'short' => 'cK'
,'desc' => '<b>[Knowledge Article]</b> permission'
,'select_type' => 'access'
)
,'canAccess' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Informations/Access'
,'short' => 'cP'
,'desc' => '<b>[Access]</b> privilege'
,'select_type' => 'access'
)
,'canPasstorage' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Informations/Passtorage'
,'short' => 'cI'
,'desc' => '<b>[Pastorage]</b> permission'
,'select_type' => 'access'
)
,'canHardware' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Informations/Device'
,'short' => 'cHw'
,'desc' => '<b>[Hardware]</b> permission'
,'select_type' => 'state'
)
,'canEdit' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Profile'
,'short' => 'cE'
,'desc' => 'Edit <b>Profile</b>'
,'select_type' => 'state'
)
,'canLogin' => array(
'color' => self::ROLE_CARD_COLOR
,'header' => 'Available function'
,'respective' => 'Profile'
,'short' => 'cE'
,'desc' => '<b>Login</b> permission'
,'select_type' => 'state'
)
);
}