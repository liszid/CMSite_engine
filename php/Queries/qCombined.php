<?php
declare(strict_types = 1);
namespace Queries;
use Toolkit\ {
	Log, Check, Valid
};
class qCombined {
	public static function Get(): array
	{
		return array('Insert' => self::Insert(), 'Select' => self::Select(), 'Update' => self::Update(), 'Delete' => self::Delete());
	}
	private static function Insert()
	{
			return "";
	}
	private static function Select()
	{
		return array(
			'User_Full' => "
				SELECT
				    `User`.userId
				    ,`User`.userId
				    ,`User`.userName
				    ,`User`.userFirstName
				    ,`User`.userLastName
				    ,`User`.userContEmail
				    ,`User`.userContPhone
				    ,`User`.userContSite
				    ,`User`.userThumbnail
				    ,`User`.isDelete
				    ,`Group`.*
				FROM `User`
				INNER JOIN `Group_Member` USING (userId)
				INNER JOIN `Group` USING (groupId)
				WHERE `User`.userId=:userId/**/"
			, 'Member_Full' => "
				SELECT
				    `User`.userId
				    ,`Group_Member`.groupMemberId
				    ,`Group`.groupName
				    ,`Group`.groupDesc
				    ,`User`.userName
				    ,`User`.isDelete
				FROM `User`
				INNER JOIN `Group_Member` USING (userId)
				INNER JOIN `Group` USING (groupId)"
			,'Huntgroup_Members' => "
				SELECT
				    `Huntgroup_Member`.huntgroupMemberId
				    ,`Huntgroup`.huntgroupName
				    ,`Huntgroup`.huntgroupDesc
				    ,`User`.userName
				    ,`User`.userId
				    ,`Huntgroup_Member`.isDelete
				FROM `User`
				INNER JOIN `Huntgroup_Member` USING (userId)
				INNER JOIN `Huntgroup` USING (huntgroupId)
				WHERE `Huntgroup`.huntgroupId=:huntgroupId/**/"
			, 'User_Huntgroups' => "
				SELECT
				    `Huntgroup`.huntgroupName
				FROM `Huntgroup_Member`
				INNER JOIN `Huntgroup` USING (huntgroupId)
				WHERE `Huntgroup_Member`.userId=:userId/**/
				ORDER BY `Huntgroup`.huntgroupName ASC"
			,'ComputerInfo_All' => "
				select
					ci.*
				from
					ComputerInfo ci
				order by
					ci.timestamp desc
				limit 60;"
			,'ProcessorInfo_All' => "
				select
					p.*
					, ci.timestamp
				from
					ComputerInfo ci
					inner join ProcessorInfo p ON ci.id = p.computer_info_id
				order by
					ci.timestamp desc
				limit 60;"
			,'MemoryModulInfo_All' => "
				select
					p.*
					, ci.timestamp
				from
					ComputerInfo ci
					inner join MemoryModuleInfo p ON ci.id = p.computer_info_id
				order by
					ci.timestamp desc
				limit 60;"
			,'DiskDriveInfo_All' => "
				select
					p.*
					, ci.timestamp
				from
					ComputerInfo ci
					inner join DiskDriveInfo p ON ci.id = p.computer_info_id
				order by
					ci.timestamp desc
				limit 60;"
			,'LogicalDiskInfo_All' => "
				select
					p.*
					, ci.timestamp
				from
					ComputerInfo ci
					inner join LogicalDiskInfo p ON ci.id = p.computer_info_id
				order by
					ci.timestamp desc
				limit 60;"
			,'NetworkAdapterInfo_All' => "
				select
					p.*
					, ci.timestamp
				from
					ComputerInfo ci
					inner join NetworkAdapterInfo p ON ci.id = p.computer_info_id
				order by
					ci.timestamp desc
				limit 60;"
			,'NetworkConnectionInfo_All' => "
				select
					p.*
					, ci.timestamp
				from
					ComputerInfo ci
					inner join NetworkConnectionInfo p ON ci.id = p.computer_info_id
				order by
					ci.timestamp desc
				limit 60;"
			,'BIOSInfo_All' => "
				select
					p.*
					, ci.timestamp
				from
					ComputerInfo ci
					inner join BIOSInfo p ON ci.id = p.computer_info_id
				order by
					ci.timestamp desc
				limit 60;"
			,'VolumeInfo_All' => "
				select
					p.*
					, ci.timestamp
				from
					ComputerInfo ci
					inner join VolumeInfo p ON ci.id = p.computer_info_id
				order by
					ci.timestamp desc
				limit 60;"
			,'MotherboardInfo_All' => "
				select
					p.*
					, ci.timestamp
				from
					ComputerInfo ci
					inner join MotherboardInfo p ON ci.id = p.computer_info_id
				order by
					ci.timestamp desc
				limit 60;"
			,'ThermalZoneInfo_All' => "
				select
					p.*
					, ci.timestamp
				from
					ComputerInfo ci
					inner join ThermalZoneInfo p ON ci.id = p.computer_info_id
				order by
					ci.timestamp desc
				limit 60;"
			, 'Performance_Full' => "
				SELECT 
					ci.id AS computer_info_id,
					ci.timestamp,
					ci.computer_name,
					ci.manufacturer,
					ci.model,
					ci.total_physical_memory,
					ci.cpu_load,
					ci.memory_load,
					ci.disk_load,
					ci.os_caption,
					ci.os_version,
					ci.os_build_number,
					CONCAT(
						'[', GROUP_CONCAT(
							CONCAT(
								'{\"name\":\"', p.name, 
								'\",\"manufacturer\":\"', p.manufacturer, 
								'\",\"max_clock_speed\":', p.max_clock_speed, 
								',\"current_clock_speed\":', p.current_clock_speed, 
								',\"number_of_cores\":', p.number_of_cores, 
								',\"number_of_logical_processors\":', p.number_of_logical_processors, 
								'}'
							)
						), ']' 
					) AS processors,
					CONCAT(
						'[', GROUP_CONCAT(
							CONCAT(
								'{\"capacity\":', m.capacity, 
								',\"speed\":', m.speed, 
								',\"manufacturer\":\"', m.manufacturer, 
								',\"serial_number\":\"', m.serial_number, 
								'\"}'
							)
						), ']' 
					) AS memory_modules,
					CONCAT(
						'[', GROUP_CONCAT(
							CONCAT(
								'{\"model\":\"', d.model, 
								'\",\"size\":', d.size, 
								',\"free_space\":', d.free_space, 
								',\"used_space\":', d.used_space, 
								',\"fragmentation_level\":', d.fragmentation_level, 
								',\"block_size\":', d.block_size, 
								'}'
							)
						), ']' 
					) AS disk_drives,
					CONCAT(
						'[', GROUP_CONCAT(
							CONCAT(
								'{\"name\":\"', ld.name, 
								'\",\"free_space\":', ld.free_space, 
								',\"size\":', ld.size, 
								'}'
							)
						), ']' 
					) AS logical_disks,
					CONCAT(
						'[', GROUP_CONCAT(
							CONCAT(
								'{\"name\":\"', na.name, 
								'\",\"mac_address\":\"', na.mac_address, 
								'\",\"speed\":', na.speed, 
								',\"received_bytes\":', na.received_bytes, 
								',\"sent_bytes\":', na.sent_bytes, 
								'}'
							)
						), ']' 
					) AS network_adapters,
					CONCAT(
						'[', GROUP_CONCAT(
							CONCAT(
								'{\"description\":\"', nc.description, 
								'\",\"ip_address\":\"', nc.ip_address, 
								'\",\"mac_address\":\"', nc.mac_address, 
								'}'
							)
						), ']' 
					) AS network_connections,
					CONCAT(
						'{\"manufacturer\":\"', b.manufacturer, 
						'\",\"version\":\"', b.version, 
						'\",\"release_date\":\"', b.release_date, 
						'\"}'
					) AS bios,
					CONCAT(
						'[', GROUP_CONCAT(
							CONCAT(
								'{\"drive_letter\":\"', v.drive_letter, 
								'\",\"file_system\":\"', v.file_system, 
								'\",\"size_remaining\":', v.size_remaining, 
								',\"size\":', v.size, 
								',\"percent_fragmentation\":', v.percent_fragmentation, 
								',\"allocation_unit_size\":', v.allocation_unit_size, 
								'}'
							)
						), ']' 
					) AS volumes,
					CONCAT(
						'{\"manufacturer\":\"', mo.manufacturer, 
						'\",\"product\":\"', mo.product, 
						'\",\"serial_number\":\"', mo.serial_number, 
						'\"}'
					) AS motherboard,
					CONCAT(
						'[', GROUP_CONCAT(
							CONCAT(
								'{\"name\":\"', tz.name, 
								'\",\"current_temperature\":', tz.current_temperature, 
								'}'
							)
						), ']' 
					) AS thermal_zones
				FROM 
					ComputerInfo ci
				LEFT JOIN ProcessorInfo p ON ci.id = p.computer_info_id
				LEFT JOIN MemoryModuleInfo m ON ci.id = m.computer_info_id
				LEFT JOIN DiskDriveInfo d ON ci.id = d.computer_info_id
				LEFT JOIN LogicalDiskInfo ld ON ci.id = ld.computer_info_id
				LEFT JOIN NetworkAdapterInfo na ON ci.id = na.computer_info_id
				LEFT JOIN NetworkConnectionInfo nc ON ci.id = nc.computer_info_id
				LEFT JOIN BIOSInfo b ON ci.id = b.computer_info_id
				LEFT JOIN VolumeInfo v ON ci.id = v.computer_info_id
				LEFT JOIN MotherboardInfo mo ON ci.id = mo.computer_info_id
				LEFT JOIN ThermalZoneInfo tz ON ci.id = tz.computer_info_id
				GROUP BY ci.id;"
			
		);
	}
	private static function Update() {
		return "";
	}
	private static function Delete() {
		return "";
	}
}
	