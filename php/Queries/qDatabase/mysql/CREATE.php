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
        ,10 =>"
            CREATE TABLE `StorageId` (
                storage_id INT AUTO_INCREMENT PRIMARY KEY,
                sym_id VARCHAR(255),
                srp_name VARCHAR(255),
                insert_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );"
        ,11 => "
            CREATE TABLE `StoragePhys` (
                sphys_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                storage_id INT NOT NULL,
                physical_capacity INT,
                usable_capacity INT,
                compression_state VARCHAR(255),
                compression_ratio DECIMAL(5,2),
                data_reduction_ratio DECIMAL(5,2),
                srdf_dse_allocated INT,
                snapshot_effective_capacity INT,
                snapshots_allocated INT,
                total_subscribed_pct DECIMAL(5,2),
                insert_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT storagePhysCascade FOREIGN KEY (storage_id) REFERENCES `StorageId` (storage_id) ON DELETE CASCADE
            );"
        ,12 => "
            CREATE TABLE `StorageTotal` (
                stotal_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                sphys_id INT NOT NULL,
                provisioned_capacity INT,
                subscribed_capacity INT,
                effective_used INT,
                effective_used_pct DECIMAL(5,2),
                allocated_capacity INT,
                allocated_capacity_pct DECIMAL(5,2),
                physical_used INT,
                used_capacity INT,
                unreducible_used_cap INT,
                compression_ratio DECIMAL(5,2),
                snap_effective_used INT,
                snap_capacity INT,
                snap_physical_used INT,
                snap_used_capacity INT,
                snap_unreducible_used_cap INT,
                compression_snapshot_ratio DECIMAL(5,2),
                insert_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT storageTotalCascade FOREIGN KEY (sphys_id) REFERENCES `StoragePhys` (sphys_id) ON DELETE CASCADE
            );"
        ,13 => "
            CREATE TABLE `StorageGroup` (
                sgroup_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                sphys_id INT NOT NULL,
                group_name VARCHAR(255),
                provisioned INT,
                subscribed_capacity INT,
                user_data INT,
                user_data_percent DECIMAL(5,2),
                total_effective_used INT,
                total_physical_used INT,
                total_physical_used_percent DECIMAL(5,2),
                total_unreducible_used INT,
                total_data_reduction_ratio DECIMAL(5,2),
                effective_used INT,
                effective_used_pct DECIMAL(5,2),
                allocated_capacity INT,
                allocated_capacity_pct DECIMAL(5,2),
                physical_used INT,
                used_capacity INT,
                unreducible_used_cap INT,
                data_reduction_ratio DECIMAL(5,2),
                compression_ratio DECIMAL(5,2),
                snap_effective_used INT,
                snap_allocated_capacity INT,
                snap_physical_used INT,
                snap_used_capacity INT,
                snap_unreducible_used_cap INT,
                snapshot_resources_used_percent DECIMAL(5,2),
                snap_data_reduction_ratio DECIMAL(5,2),
                compression_snapshot_ratio DECIMAL(5,2),
                insert_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT storageGroupCascade FOREIGN KEY (sphys_id) REFERENCES `StoragePhys` (sphys_id) ON DELETE CASCADE
            );"
         
        ,20 => "
            CREATE TABLE ComputerInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                timestamp DATETIME NOT NULL,
                computer_name VARCHAR(255),
                manufacturer VARCHAR(255),
                model VARCHAR(255),
                total_physical_memory BIGINT,
                cpu_load DECIMAL(5,2),
                memory_load DECIMAL(5,2),
                disk_load DECIMAL(5,2),
                os_caption VARCHAR(255),
                os_version VARCHAR(255),
                os_build_number VARCHAR(255)
            );"
        ,21 => "
                CREATE TABLE ProcessorInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                computer_info_id INT,
                name VARCHAR(255),
                manufacturer VARCHAR(255),
                max_clock_speed INT,
                current_clock_speed INT,
                number_of_cores INT,
                number_of_logical_processors INT,
                FOREIGN KEY (computer_info_id) REFERENCES ComputerInfo(id)
            );"
        ,22 => "
                CREATE TABLE MemoryModuleInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                computer_info_id INT,
                capacity BIGINT,
                speed INT,
                manufacturer VARCHAR(255),
                serial_number VARCHAR(255),
                FOREIGN KEY (computer_info_id) REFERENCES ComputerInfo(id)
            );"
        ,23 => "
            CREATE TABLE DiskDriveInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                computer_info_id INT,
                model VARCHAR(255),
                size BIGINT,
                free_space BIGINT,
                used_space BIGINT,
                fragmentation_level DECIMAL(5,2),
                block_size INT,
                FOREIGN KEY (computer_info_id) REFERENCES ComputerInfo(id)
            );"
        ,24 => "
            CREATE TABLE LogicalDiskInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                computer_info_id INT,
                name VARCHAR(255),
                free_space BIGINT,
                size BIGINT,
                FOREIGN KEY (computer_info_id) REFERENCES ComputerInfo(id)
            );"
        ,25 => "
            CREATE TABLE NetworkAdapterInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                computer_info_id INT,
                name VARCHAR(255),
                mac_address VARCHAR(255),
                speed BIGINT,
                received_bytes BIGINT,
                sent_bytes BIGINT,
                FOREIGN KEY (computer_info_id) REFERENCES ComputerInfo(id)
            );"
        ,26 => "
            CREATE TABLE NetworkConnectionInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                computer_info_id INT,
                description VARCHAR(255),
                ip_address VARCHAR(255),
                mac_address VARCHAR(255),
                FOREIGN KEY (computer_info_id) REFERENCES ComputerInfo(id)
            );"
        ,27 => "
            CREATE TABLE BIOSInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                computer_info_id INT,
                manufacturer VARCHAR(255),
                version VARCHAR(255),
                release_date DATETIME,
                FOREIGN KEY (computer_info_id) REFERENCES ComputerInfo(id)
            );"
        ,28 => "
            CREATE TABLE VolumeInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                computer_info_id INT,
                drive_letter VARCHAR(5),
                file_system VARCHAR(255),
                size_remaining BIGINT,
                size BIGINT,
                percent_fragmentation DECIMAL(5,2),
                allocation_unit_size INT,
                FOREIGN KEY (computer_info_id) REFERENCES ComputerInfo(id)
            );"
        ,29 => "
            CREATE TABLE MotherboardInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                computer_info_id INT,
                manufacturer VARCHAR(255),
                product VARCHAR(255),
                serial_number VARCHAR(255),
                FOREIGN KEY (computer_info_id) REFERENCES ComputerInfo(id)
            );"
        ,30 => "
            CREATE TABLE ThermalZoneInfo (
                id INT AUTO_INCREMENT PRIMARY KEY,
                computer_info_id INT,
                name VARCHAR(255),
                current_temperature DECIMAL(5,2),
                FOREIGN KEY (computer_info_id) REFERENCES ComputerInfo(id)
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