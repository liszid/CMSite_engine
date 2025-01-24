<?php

declare(strict_types=1);

namespace Queries\qDatabase\mysql;

interface CREATE
{
     const CREATE = array(
        0 => "
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
        ,10 => "
            CREATE TABLE IF NOT EXISTS `Symmetrix` (
                id INT AUTO_INCREMENT NOT NULL,
                symId VARCHAR(20) NOT NULL,
                CONSTRAINT primaryKeySymId PRIMARY KEY (id)
            );"
        ,11 => "
            CREATE TABLE IF NOT EXISTS `SRP` (
                id INT AUTO_INCREMENT NOT NULL,
                symmetrix_id INT NOT NULL,
                name VARCHAR(50),
                physical_capacity_gigabytes DECIMAL(10, 2),
                usable_capacity_gigabytes DECIMAL(10, 2),
                compression_state VARCHAR(20),
                compression_ratio VARCHAR(10),
                data_reduction_ratio VARCHAR(10),
                srdf_dse_allocated_gigabytes VARCHAR(10),
                snapshot_effective_capacity_gigabytes DECIMAL(10, 2),
                snapshots_allocated_gigabytes DECIMAL(10, 2),
                total_subscribed_pct VARCHAR(10),
                input_date DATETIME,
                CONSTRAINT primaryKeySRPId PRIMARY KEY (id),
                CONSTRAINT srpOnSymmetrixCascade FOREIGN KEY (symmetrix_id) REFERENCES `Symmetrix` (id) ON DELETE CASCADE
            );"
        ,12 => "
            CREATE TABLE IF NOT EXISTS `SG_Info` (
                id INT AUTO_INCREMENT NOT NULL,
                srp_id INT NOT NULL,
                SG_Name VARCHAR(50),
                provisioned_gigabytes DECIMAL(10, 2),
                subscribed_capacity_gigabytes DECIMAL(10, 2),
                user_data_gigabytes DECIMAL(10, 2),
                total_effective_used_gigabytes DECIMAL(10, 2),
                total_physical_used_gigabytes DECIMAL(10, 2),
                total_unreducible_used_gigabytes DECIMAL(10, 2),
                total_data_reduction_ratio VARCHAR(10),
                effective_used_gigabytes DECIMAL(10, 2),
                allocated_capacity_gigabytes DECIMAL(10, 2),
                physical_used_gigabytes DECIMAL(10, 2),
                used_capacity_gigabytes DECIMAL(10, 2),
                unreducible_used_cap_gigabytes DECIMAL(10, 2),
                data_reduction_ratio VARCHAR(10),
                compression_ratio VARCHAR(10),
                snap_effective_used_gigabytes DECIMAL(10, 2),
                snap_allocated_capacity_gigabytes DECIMAL(10, 2),
                snap_physical_used_gigabytes DECIMAL(10, 2),
                snap_used_capacity_gigabytes DECIMAL(10, 2),
                snap_unreducible_used_cap_gigabytes DECIMAL(10, 2),
                snap_data_reduction_ratio VARCHAR(10),
                compression_snapshot_ratio VARCHAR(10),
                input_date DATETIME,
                CONSTRAINT primaryKeySGInfoId PRIMARY KEY (id),
                CONSTRAINT sgInfoOnSRPIdCascade FOREIGN KEY (srp_id) REFERENCES `SRP` (id) ON DELETE CASCADE
            );"
        ,13 => "
            CREATE VIEW IF NOT EXISTS `SG_View` AS SELECT 
                s.symid,
                sr.name AS srp_name,
                sg.SG_Name,
                sg.provisioned_gigabytes,
                sg.subscribed_capacity_gigabytes,
                sg.user_data_gigabytes,
                sg.total_effective_used_gigabytes,
                sg.total_physical_used_gigabytes,
                sg.total_unreducible_used_gigabytes,
                sg.total_data_reduction_ratio,
                sg.effective_used_gigabytes,
                sg.allocated_capacity_gigabytes,
                sg.physical_used_gigabytes,
                sg.used_capacity_gigabytes,
                sg.unreducible_used_cap_gigabytes,
                sg.data_reduction_ratio,
                sg.compression_ratio,
                sg.snap_effective_used_gigabytes,
                sg.snap_allocated_capacity_gigabytes,
                sg.snap_physical_used_gigabytes,
                sg.snap_used_capacity_gigabytes,
                sg.snap_unreducible_used_cap_gigabytes,
                sg.snap_data_reduction_ratio,
                sg.compression_snapshot_ratio,
                sg.input_date
            FROM 
                Symmetrix s
            JOIN 
                SRP sr ON s.id = sr.symmetrix_id
            JOIN 
                SG_Info sg ON sr.id = sg.srp_id;"
        ,14 => "
            CREATE TABLE IF NOT EXISTS `Total_SG` (
                id INT AUTO_INCREMENT NOT NULL,
                srp_id INT NOT NULL,
                provisioned_capacity_gigabytes DECIMAL(10, 2),
                subscribed_capacity_gigabytes DECIMAL(10, 2),
                effective_used_gigabytes VARCHAR(10),
                allocated_capacity_gigabytes VARCHAR(10),
                physical_used_gigabytes DECIMAL(10, 2),
                used_capacity_gigabytes DECIMAL(10, 2),
                unreducible_used_cap_gigabytes DECIMAL(10, 2),
                compression_ratio VARCHAR(10),
                snap_effective_used_gigabytes VARCHAR(10),
                snap_capacity_gigabytes VARCHAR(10),
                snap_physical_used_gigabytes DECIMAL(10, 2),
                snap_used_capacity_gigabytes DECIMAL(10, 2),
                snap_unreducible_used_cap_gigabytes DECIMAL(10, 2),
                compression_snapshot_ratio VARCHAR(10),
                input_date DATETIME,
                CONSTRAINT primaryKeySGTotalId PRIMARY KEY (id),
                CONSTRAINT sgTotalOnSRPIdCascade FOREIGN KEY (srp_id) REFERENCES `SRP` (id) ON DELETE CASCADE
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

?>