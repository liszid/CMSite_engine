<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\
{
    Log
    ,Check
    ,Valid
};

class qDatabase
{
	public static function Get(): array
    {
		return array(
			'Create' => self::Create()
			,'Insert' => self::Insert()
			,'Select' => self::Select()
		);
	}

	private static function Create()
	{
		return array(
			'Database' => "
				CREATE DATABASE IF NOT EXISTS `plfemnag_tattoo`"
			,0 => "
				CREATE TABLE IF NOT EXISTS `User`(
					userId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					userName VARCHAR(32) NOT NULL UNIQUE,
					pWord VARCHAR(32) NOT NULL,
					userFirstName VARCHAR(64) NULL,
					userLastName VARCHAR(64) NULL,
					userContEmail VARCHAR(128) NOT NULL UNIQUE,
					userContPhone VARCHAR(32) NULL,
					userContSite VARCHAR(64) NULL,
					userThumbnail VARCHAR(255) DEFAULT 'user',
					userDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT PKUser PRIMARY KEY (userId),
					CONSTRAINT userUserIdUnique UNIQUE (userId),
					CONSTRAINT userUserNameUnique UNIQUE (userName),
					CONSTRAINT userUserContEmailUnique UNIQUE (userContEmail)
				);"
			,1 => "
				CREATE TABLE IF NOT EXISTS `Group`(
					groupId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					groupName VARCHAR(32) NOT NULL,
					groupDesc VARCHAR(256) NOT NULL,
					canAdministrative INT(1) DEFAULT 0,
					mngGroups INT(1) DEFAULT 0,
					mngHuntgroups INT(1) DEFAULT 0,
					mngUsers INT(1) DEFAULT 0,
					mngTools INT(1) DEFAULT 0,
					canUsers INT(1) DEFAULT 0,
					canEdit INT(1) DEFAULT 0,
					canLogin INT(1) DEFAULT 0,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyGroup PRIMARY KEY (groupId),
					CONSTRAINT groupGroupIdUnique UNIQUE (groupId),
					CONSTRAINT groupGroupNameUnique UNIQUE (groupName)
				);"
			,2 => "
				CREATE TABLE IF NOT EXISTS `Group_Member`(
					groupMemberId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					userId INT(6) UNSIGNED NOT NULL,
					groupId INT(6) UNSIGNED NOT NULL,
					isDelete INT(6) UNSIGNED DEFAULT 1,
					CONSTRAINT primaryKeyGroup_Member PRIMARY KEY (groupMemberId),
					CONSTRAINT groupMemberGroupCascade FOREIGN KEY (groupId) REFERENCES `Group` (groupId) ON DELETE CASCADE,
					CONSTRAINT groupMemberUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE
				);"
			,3 => "
				CREATE TABLE IF NOT EXISTS `Huntgroup`(
					huntgroupId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					huntgroupName VARCHAR(32) NOT NULL,
					huntgroupDesc VARCHAR(256) NOT NULL,
					isDelete INT(6) UNSIGNED DEFAULT 1,
					CONSTRAINT primaryKeyHuntroup PRIMARY KEY (huntgroupId)
				);"
			,4 => "
				CREATE TABLE IF NOT EXISTS `Huntgroup_Member`(
					huntgroupMemberId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					userId INT(6) UNSIGNED NOT NULL,
					huntgroupId INT(6) UNSIGNED NOT NULL,
					isDelete INT(6) UNSIGNED DEFAULT 1,
					CONSTRAINT primaryKeyHuntgroup_Member PRIMARY KEY (huntgroupMemberId),
					CONSTRAINT huntgroupMemberGroupCascade FOREIGN KEY (huntgroupId) REFERENCES `Huntgroup` (huntgroupId) ON DELETE CASCADE,
					CONSTRAINT huntgroupMemberUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE
				);"
			,90 => "
				CREATE TABLE IF NOT EXISTS `Log`(
					logId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					logType VARCHAR(64) NULL,
					logAction VARCHAR(64) NULL,
					logCategory VARCHAR(64) NULL,
					logText TEXT NULL,
					logBool VARCHAR(16) NULL,
					logDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					userId INT(6) UNSIGNED NOT NULL,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyLog PRIMARY KEY (logId),
					CONSTRAINT logUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE
				);"
		);
	}

	private static function Insert()
	{
		return array(
			0 => "
				INSERT INTO `User`(
					userName, pWord, userThumbnail, userFirstName, userLastName, userContEmail, userContPhone, userContSite, isDelete
				) VALUES
					('admin', md5('ksys'), 'cogs', 'Admin', '', 'admin@p-l1fem4nag3r.hu/', '0036301234567', 'Törökbálint', 0)"
			,1 => "
				INSERT INTO `Group`(
					groupName, groupDesc, canAdministrative, mngGroups, mngHuntgroups, mngUsers, mngTools, canUsers, canEdit, canLogin, isDelete
				) VALUES
					 ('Adminisztrátor',	 'Adminisztratív jogosultság',                       1, 1, 1, 1, 1, 1, 1, 1, 0)
					,('Alapértelmezett', 'Alapértelmezett jogosultság',                      0, 0, 0, 0, 0, 1, 1, 1, 0)
					,('Korlátozott',     'Korlátozott hozzáféréssel rendelkezö jogosultság', 0, 0, 0, 0, 0, 1, 1, 1, 0)
					,('Törölt',          'Törölt felhasználók jogosultsága',                 0, 0, 0, 0, 0, 0, 0, 0, 0)"
			,2 => "
				INSERT INTO `Group_Member`(
					userId, groupId, isDelete
				) VALUES
					(1, 1, 0);"
			,3 => "
				INSERT INTO `Huntgroup`(
					huntgroupName, huntgroupDesc, isDelete
				) VALUES
					('Alapértelmezett', 'Alapértelmezett adatok gyüjtő csoportja', 0)
					,('#_admin', '', 0);"
			,4 => "
				INSERT INTO `Huntgroup_Member`(
					userId, huntgroupId, isDelete
				) VALUES
					(1, 1, 0)
					,(1, 2, 0);"
		);
	}
	private static function Select()
	{
		return array(
			'Database' => "
				SELECT
					SCHEMA_NAME
				FROM
					INFORMATION_SCHEMA.SCHEMATA
				WHERE
					SCHEMA_NAME = 'plfmnag'",
			'Table' => "
				SELECT
					TABLE_NAME
				FROM
					INFORMATION_SCHEMA.TABLES
				WHERE
					TABLE_SCHEMA=:sqlDB/**/
					AND TABLE_NAME=:tableName/**/"
		);
	}
}
