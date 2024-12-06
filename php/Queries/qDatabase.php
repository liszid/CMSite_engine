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
					canCompany INT(1) DEFAULT 0,
					canKnowledge INT(1) DEFAULT 0,
					canAccess INT(1) DEFAULT 0,
					canPasstorage INT(1) DEFAULT 0,
					canHardware INT(1) DEFAULT 0,
					canInformations INT(1) DEFAULT 0,
					canCalendar INT(1) DEFAULT 0,
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
			,5 => "
				CREATE TABLE IF NOT EXISTS `Calendar`(
					eventId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					userId INT(6) UNSIGNED NOT NULL,
					eventTitle VARCHAR(128) NOT NULL,
					eventDescription VARCHAR(128) NULL,
					eventStartDate DATETIME NOT NULL,
					eventEndDate DATETIME NOT NULL,
					eventColor VARCHAR(32) NULL DEFAULT '#198754',
					eventEveryYear BOOLEAN NOT NULL DEFAULT FALSE,
					CONSTRAINT primaryKeyCalendar PRIMARY KEY (eventId),
					CONSTRAINT calendarUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE
				);"
			,6 => "
				CREATE TABLE IF NOT EXISTS `Kanban`(
					kanbanId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					kanbanTitle VARCHAR(128) NULL,
					kanbanText LONGTEXT NULL,
					kanbanDueDate DATETIME NOT NULL,
					kanbanUpdateDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					userId INT(6) UNSIGNED NOT NULL,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyKanban PRIMARY KEY (kanbanId),
					CONSTRAINT kanbanUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE
				);"
			,7 => "
				CREATE TABLE IF NOT EXISTS `Kanban_Member`(
					kanbanMemberId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					kanbanId INT(6) UNSIGNED NOT NULL,
					huntgroupId INT(6) UNSIGNED NOT NULL,
					isDelete INT(6) UNSIGNED DEFAULT 1,
					CONSTRAINT primaryKeyPasstorage_Member PRIMARY KEY (kanbanMemberId),
					CONSTRAINT kanbanMemberHuntgroupCascade FOREIGN KEY (huntgroupId) REFERENCES `Huntgroup` (huntgroupId) ON DELETE CASCADE,
					CONSTRAINT kanbanIdCascade FOREIGN KEY (kanbanId) REFERENCES `Passtorage` (kanbanId) ON DELETE CASCADE
				);"
			,10 => "
				CREATE TABLE IF NOT EXISTS `Company`(
					companyId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					userId INT(6) UNSIGNED NOT NULL,
					companyName VARCHAR(128) NOT NULL,
					companyDesc VARCHAR(256) NULL,
					companyTaxNumber VARCHAR(64) NULL,
					companyRegisteredNumber VARCHAR(64) NULL,
					companyAddressCity VARCHAR(64) NULL,
					companyAddressPostcode VARCHAR(12) NULL,
					companyAddressStreet VARCHAR(128) NULL,
					companyDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyCompany PRIMARY KEY (companyId),
					CONSTRAINT companyUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE
				);"
			,11 => "
				CREATE TABLE IF NOT EXISTS `Company_Site_Type`(
					companySiteTypeId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					companySiteTypeName VARCHAR(128) NOT NULL,
					companySiteTypeDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyCompanySiteType PRIMARY KEY (companySiteTypeId)
				);"
			,12 => "
				CREATE TABLE IF NOT EXISTS `Company_Site`(
					companySiteId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					companyId INT(6) UNSIGNED NOT NULL,
					userId INT(6) UNSIGNED NOT NULL,
					companySiteName VARCHAR(128) NOT NULL,
					companySiteDesc VARCHAR(256) NULL,
					companySiteOwnerFirstName VARCHAR(64) NULL,
					companySiteOwnerLastName VARCHAR(64) NULL,
					companySiteOwnerEmail VARCHAR(128) NULL,
					companySiteOwnerPhone VARCHAR(32) NULL,
					companySiteSubOwnerFirstName VARCHAR(64) NULL,
					companySiteSubOwnerLastName VARCHAR(64) NULL,
					companySiteSubOwnerEmail VARCHAR(128) NULL,
					companySiteSubOwnerPhone VARCHAR(32) NULL,
					companySiteAddressCity VARCHAR(64) NULL,
					companySiteAddressPostcode VARCHAR(4) NULL,
					companySiteAddressStreet VARCHAR(128) NULL,
					companySiteEmail VARCHAR(128) NULL,
					companySitePhone VARCHAR(32) NULL,
					companySiteTypeId INT(6) UNSIGNED NOT NULL DEFAULT 1,
					companySiteDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyCompanySite PRIMARY KEY (companySiteId),
					CONSTRAINT companySiteCompanyCascade FOREIGN KEY (companyId) REFERENCES `Company` (companyId) ON DELETE CASCADE,
					CONSTRAINT companySiteUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE,
					CONSTRAINT companySiteTypeCascade FOREIGN KEY (companySiteTypeId) REFERENCES `Company_Site_Type` (companySiteTypeId) ON DELETE CASCADE
				);"
			,20 => "
				CREATE TABLE IF NOT EXISTS `Passtorage`(
					passtorageId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					passtorageName VARCHAR(64) NULL,
					passtorageDesc VARCHAR(256) NULL,
					passtorageDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					userId INT(6) UNSIGNED NOT NULL,
					companySiteId INT(6) UNSIGNED NOT NULL,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyPasstorage PRIMARY KEY (passtorageId),
					CONSTRAINT passtorageUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE,
					CONSTRAINT passtorageCompanySiteCascade FOREIGN KEY (companySiteId) REFERENCES `Company_Site` (companySiteId) ON DELETE CASCADE
				);"
			,22 => "
				CREATE TABLE IF NOT EXISTS `Passtorage_File`(
					passtorageFileId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					passtorageFilePath TEXT NULL,
					passtorageFileName TEXT NULL,
					passtorageFileType TEXT NULL,
					passtorageFileTmpName TEXT NULL,
					passtorageFileSize INT(16),
					passtorageFileStatus INT(1) DEFAULT 1,
					passtorageFileDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					passtorageId INT(6) UNSIGNED NOT NULL,
					userId INT(6) UNSIGNED NOT NULL,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyPasstorageFile PRIMARY KEY (passtorageFileId),
					CONSTRAINT passtorageFileIdCascade FOREIGN KEY (passtorageId) REFERENCES `Passtorage` (passtorageId) ON DELETE CASCADE,
					CONSTRAINT passtorageFileUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE
				);"
			,29 => "
				CREATE TABLE IF NOT EXISTS `Passtorage_Member`(
					passtorageMemberId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					passtorageId INT(6) UNSIGNED NOT NULL,
					huntgroupId INT(6) UNSIGNED NOT NULL,
					isDelete INT(6) UNSIGNED DEFAULT 1,
					CONSTRAINT primaryKeyPasstorage_Member PRIMARY KEY (passtorageMemberId),
					CONSTRAINT passtorageMemberHuntgroupCascade FOREIGN KEY (huntgroupId) REFERENCES `Huntgroup` (huntgroupId) ON DELETE CASCADE,
					CONSTRAINT passtorageMemberPasstorageCascade FOREIGN KEY (passtorageId) REFERENCES `Passtorage` (passtorageId) ON DELETE CASCADE
				);"
			,30 => "
				CREATE TABLE IF NOT EXISTS `Access`(
					accessId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					passtorageId INT(6) UNSIGNED NOT NULL,
					accessUsername VARCHAR(128) NULL,
					accessPassword VARCHAR(128) NULL,
					accessLabel TINYTEXT NULL,
					accessLink TEXT NULL,
					accessDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					userId INT(6) UNSIGNED NOT NULL,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyAccess PRIMARY KEY (accessId),
					CONSTRAINT accessPasstorageCascade FOREIGN KEY (passtorageId) REFERENCES `Passtorage` (passtorageId) ON DELETE CASCADE,
					CONSTRAINT accessUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE
				);"
			,40 => "
				CREATE TABLE IF NOT EXISTS `Knowledge_Type`(
					knowledgeTypeId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					knowledgeTypeName VARCHAR(128) NULL,
					knowledgeTypeDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyKnowledgeType PRIMARY KEY (knowledgeTypeId)
				);"
			,41 => "
				CREATE TABLE IF NOT EXISTS `Knowledge`(
					knowledgeId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					knowledgeTypeId INT(6) UNSIGNED NOT NULL,
					knowledgeTitle VARCHAR(128) NULL,
					knowledgeText LONGTEXT NULL,
					knowledgeLabel TEXT NULL,
					knowledgeDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					companyId INT(6) UNSIGNED NOT NULL,
					userId INT(6) UNSIGNED NOT NULL,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyKnowledge PRIMARY KEY (knowledgeId),
					CONSTRAINT knowledgeTypeCascade FOREIGN KEY (knowledgeTypeId) REFERENCES `Knowledge_Type` (knowledgeTypeId) ON DELETE CASCADE,
					CONSTRAINT knowledgeUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE,
					CONSTRAINT knowledgeCompanyCascade FOREIGN KEY (companyId) REFERENCES `Company` (companyId) ON DELETE CASCADE
				);"
			,42 => "
				CREATE TABLE IF NOT EXISTS `Knowledge_File`(
					knowledgeFileId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					knowledgeFilePath TEXT NULL,
					knowledgeFileName TEXT NULL,
					knowledgeFileType TEXT NULL,
					knowledgeFileTmpName TEXT NULL,
					knowledgeFileSize INT(16),
					knowledgeFileStatus INT(1) DEFAULT 1,
					knowledgeFileDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					knowledgeId INT(6) UNSIGNED NOT NULL,
					userId INT(6) UNSIGNED NOT NULL,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyKnowledgeFile PRIMARY KEY (knowledgeFileId),
					CONSTRAINT knowledgeFileIdCascade FOREIGN KEY (knowledgeId) REFERENCES `Knowledge` (knowledgeId) ON DELETE CASCADE,
					CONSTRAINT knowledgeFileUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE
				);"
			,50 => "
				CREATE TABLE IF NOT EXISTS `Hardware`(
					hardwareId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					hardwareName VARCHAR(64) NULL,
					hardwareDesc VARCHAR(64) NULL,
					hardwarePrice VARCHAR(64) NULL,
					hardwareDateIn VARCHAR(64) NULL,
					hardwareGuaranteeDate VARCHAR(64) NULL,
					hardwareDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					userId INT(6) UNSIGNED NOT NULL,
					companySiteId INT(6) UNSIGNED NOT NULL,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyHardware PRIMARY KEY (hardwareId),
					CONSTRAINT hardwareUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE,
					CONSTRAINT hardwareCompanySiteCascade FOREIGN KEY (companySiteId) REFERENCES `Company_Site` (companySiteId) ON DELETE CASCADE
				);"//
			,52 => "
				CREATE TABLE IF NOT EXISTS `Hardware_File`(
					hardwareFileId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					hardwareFilePath TEXT NULL,
					hardwareFileName TEXT NULL,
					hardwareFileType TEXT NULL,
					hardwareFileTmpName TEXT NULL,
					hardwareFileSize INT(16),
					hardwareFileStatus INT(1) DEFAULT 1,
					hardwareFileDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
					hardwareId INT(6) UNSIGNED NOT NULL,
					userId INT(6) UNSIGNED NOT NULL,
					isDelete INT(1) DEFAULT 1,
					CONSTRAINT primaryKeyHardwareFile PRIMARY KEY (hardwareFileId),
					CONSTRAINT hardwareFileUserCascade FOREIGN KEY (userId) REFERENCES `User` (userId) ON DELETE CASCADE,
					CONSTRAINT hardwareFileIdCascade FOREIGN KEY (hardwareId) REFERENCES `Hardware` (hardwareId) ON DELETE CASCADE
				);"
			,59 => "
				CREATE TABLE IF NOT EXISTS `Hardware_Member`(
					hardwareMemberId INT(6) UNSIGNED AUTO_INCREMENT NOT NULL,
					hardwareId INT(6) UNSIGNED NOT NULL,
					huntgroupId INT(6) UNSIGNED NOT NULL,
					isDelete INT(6) UNSIGNED DEFAULT 1,
					CONSTRAINT primaryKeyHardware_Member PRIMARY KEY (hardwareMemberId),
					CONSTRAINT hardwareMemberHuntgroupCascade FOREIGN KEY (huntgroupId) REFERENCES `Huntgroup` (huntgroupId) ON DELETE CASCADE,
					CONSTRAINT hardwareMemberHardwareCascade FOREIGN KEY (hardwareId) REFERENCES `Hardware` (hardwareId) ON DELETE CASCADE
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
					groupName, groupDesc, canAdministrative, mngGroups, mngHuntgroups, mngUsers, mngTools, canUsers, canCompany, canKnowledge, canAccess, canPasstorage, canHardware, canInformations, canCalendar, canEdit, canLogin, isDelete
				) VALUES
					 ('Adminisztrátor',	 'Adminisztratív jogosultság',                       1, 1, 1, 1, 1, 1, 7, 7, 7, 7, 7, 7, 1, 1, 1, 0)
					,('Alapértelmezett', 'Alapértelmezett jogosultság',                      0, 0, 0, 0, 0, 1, 7, 7, 7, 7, 7, 7, 1, 1, 1, 0)
					,('Korlátozott',     'Korlátozott hozzáféréssel rendelkezö jogosultság', 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 0)
					,('Törölt',          'Törölt felhasználók jogosultsága',                 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)"
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
			,10 => "
				INSERT INTO `Company`(
					companyId, userId, companyName, companyDesc, companyTaxNumber, companyRegisteredNumber, companyAddressCity, companyAddressPostcode, companyAddressStreet, isDelete
				) VALUES
					(1, 1, 'Alapértelmezett', '-', '-', '-', '-', '0', '-', 0);"
			,11 => "
				INSERT INTO `Company_Site_Type`(
					companySiteTypeName, isDelete
				) VALUES
					('Alapértelmezett', 0)
					,('Központ',0)"
			,12 => "
				INSERT INTO `Company_Site`(
					companySiteId, companyId, userId, companySiteName, companySiteDesc, companySiteOwnerFirstName, companySiteOwnerLastName, companySiteOwnerEmail, companySiteOwnerPhone, companySiteSubOwnerFirstName, companySiteSubOwnerLastName, companySiteSubOwnerEmail, companySiteSubOwnerPhone, companySiteAddressCity, companySiteAddressPostcode, companySiteAddressStreet, companySiteEmail, companySitePhone, companySiteTypeId, isDelete
				) VALUES
				(1, 1, 1, 'Alapértelmezett', '-', '-', '-', '-', 0,'-','-', '-', 0, '-', 0, '-', '-', 0, 1, 0);"
			,20 => "
				INSERT INTO `Passtorage`(
					passtorageName, userId, companySiteId, isDelete
				) VALUES
				 ('Alapértelmezett', 1,1,0)"
			,29 => "
				INSERT INTO `Passtorage_Member`(
					passtorageId, huntgroupId, isDelete
				) VALUES
				(1,1,0)"
			,40 => "
				INSERT INTO `Knowledge_Type`(
					knowledgeTypeName, isDelete
				) VALUES
				('Általános',0)"
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
					SCHEMA_NAME = 'plfemnag_tattoo'",
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
