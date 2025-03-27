<?php
$ps1File = 'LaptopData.ps1';
$command = "powershell.exe -ExecutionPolicy Bypass -File \"$ps1File\"";
$output = shell_exec($command);

$GLOBALS["Database"] = [
	"user" => "plfmnag",
	"pass" => "plfmnag",
	"host" => "localhost",
	"port" => 3306,
	"db" => "cap_mngmt",
	"type" => "mysql",
];
$directory = "C:\\Development\\XAMPP\\htdocs\\public_html\\capmng\\import\\";
$files = glob($directory . "ComputerInfo_*.xml");

foreach ($files as $filepath) {
	$filename = basename($filepath);
	if (strpos($filename, "ComputerInfo_") === 0) {
		list($prefix, $timestamp) = explode("_", $filename, 2);
		$timestamp = substr($timestamp, 0, -4); // Távolítsa el a ".xml" részt a végéről
		$xml = simplexml_load_file($filepath);
		$conn = new mysqli(
			$GLOBALS["Database"]["host"],
			$GLOBALS["Database"]["user"],
			$GLOBALS["Database"]["pass"],
			$GLOBALS["Database"]["db"],
			$GLOBALS["Database"]["port"]
		);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		$stmt = $conn->prepare("INSERT INTO ComputerInfo (
								timestamp, computer_name, manufacturer, model, total_physical_memory, 
								cpu_load, memory_load, disk_load, os_caption, os_version, os_build_number
							) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param(
			"ssssiddssss",
			$timestamp,
			$xml->ComputerSystem->Name,
			$xml->ComputerSystem->Manufacturer,
			$xml->ComputerSystem->Model,
			$xml->ComputerSystem->TotalPhysicalMemory,
			$xml->Performance->CpuLoad,
			$xml->Performance->MemoryLoad,
			$xml->Performance->DiskLoad,
			$xml->OperatingSystem->Caption,
			$xml->OperatingSystem->Version,
			$xml->OperatingSystem->BuildNumber
		);
		$stmt->execute();
		$computer_info_id = $stmt->insert_id; // Az újonnan létrehozott ComputerInfo rekord azonosítója
		$stmt = $conn->prepare(
			"INSERT INTO ProcessorInfo (computer_info_id, name, manufacturer, max_clock_speed, current_clock_speed, number_of_cores, number_of_logical_processors) VALUES (?, ?, ?, ?, ?, ?, ?)"
		);
		foreach ($xml->Processors->Processor as $processor) {
			$stmt->bind_param(
				"issiiii",
				$computer_info_id,
				$processor->Name,
				$processor->Manufacturer,
				$processor->MaxClockSpeed,
				$processor->CurrentClockSpeed,
				$processor->NumberOfCores,
				$processor->NumberOfLogicalProcessors
			);
			$stmt->execute();
		}
		$stmt = $conn->prepare(
			"INSERT INTO MemoryModuleInfo (computer_info_id, capacity, speed, manufacturer, serial_number) VALUES (?, ?, ?, ?, ?)"
		);
		foreach ($xml->MemoryModules->MemoryModule as $memory) {
			$stmt->bind_param(
				"iiiss",
				$computer_info_id,
				$memory->Capacity,
				$memory->Speed,
				$memory->Manufacturer,
				$memory->SerialNumber
			);
			$stmt->execute();
		}
		$stmt = $conn->prepare(
			"INSERT INTO DiskDriveInfo (computer_info_id, model, size, free_space, used_space, fragmentation_level, block_size) VALUES (?, ?, ?, ?, ?, ?, ?)"
		);
		foreach ($xml->DiskDrives->DiskDrive as $disk) {
			$stmt->bind_param(
				"isiiiii",
				$computer_info_id,
				$disk->Model,
				$disk->Size,
				$disk->FreeSpace,
				$disk->UsedSpace,
				$disk->FragmentationLevel,
				$disk->BlockSize
			);
			$stmt->execute();
		}
		$stmt = $conn->prepare(
			"INSERT INTO LogicalDiskInfo (computer_info_id, name, free_space, size) VALUES (?, ?, ?, ?)"
		);
		foreach ($xml->LogicalDisks->LogicalDisk as $disk) {
			$stmt->bind_param("isii", $computer_info_id, $disk->Name, $disk->FreeSpace, $disk->Size);
			$stmt->execute();
		}
		$stmt = $conn->prepare(
			"INSERT INTO NetworkAdapterInfo (computer_info_id, name, mac_address, speed, received_bytes, sent_bytes) VALUES (?, ?, ?, ?, ?, ?)"
		);
		foreach ($xml->NetworkAdapters->NetworkAdapter as $adapter) {
			$stmt->bind_param(
				"issiii",
				$computer_info_id,
				$adapter->Name,
				$adapter->MACAddress,
				$adapter->Speed,
				$adapter->ReceivedBytes,
				$adapter->SentBytes
			);
			$stmt->execute();
		}
		$stmt = $conn->prepare(
			"INSERT INTO NetworkConnectionInfo (computer_info_id, description, ip_address, mac_address) VALUES (?, ?, ?, ?)"
		);
		foreach ($xml->NetworkConnections->NetworkConnection as $connection) {
			$stmt->bind_param(
				"isss",
				$computer_info_id,
				$connection->Description,
				$connection->IPAddress,
				$connection->MACAddress
			);
			$stmt->execute();
		}
		$stmt = $conn->prepare(
			"INSERT INTO BIOSInfo (computer_info_id, manufacturer, version, release_date) VALUES (?, ?, ?, ?)"
		);
		$stmt->bind_param(
			"isss",
			$computer_info_id,
			$xml->BIOS->Manufacturer,
			$xml->BIOS->Version,
			$xml->BIOS->ReleaseDate
		);
		$stmt->execute();
		$stmt = $conn->prepare(
			"INSERT INTO VolumeInfo (computer_info_id, drive_letter, file_system, size_remaining, size, percent_fragmentation, allocation_unit_size) VALUES (?, ?, ?, ?, ?, ?, ?)"
		);
		foreach ($xml->Volumes->Volume as $volume) {
			$stmt->bind_param(
				"isiiiii",
				$computer_info_id,
				$volume->DriveLetter,
				$volume->FileSystem,
				$volume->SizeRemaining,
				$volume->Size,
				$volume->PercentFragmentation,
				$volume->AllocationUnitSize
			);
			$stmt->execute();
		}
		$stmt = $conn->prepare(
			"INSERT INTO MotherboardInfo (computer_info_id, manufacturer, product, serial_number) VALUES (?, ?, ?, ?)"
		);
		$stmt->bind_param(
			"isss",
			$computer_info_id,
			$xml->Motherboard->Manufacturer,
			$xml->Motherboard->Product,
			$xml->Motherboard->SerialNumber
		);
		$stmt->execute();
		$stmt = $conn->prepare(
			"INSERT INTO ThermalZoneInfo (computer_info_id, name, current_temperature) VALUES (?, ?, ?)"
		);
		foreach ($xml->ThermalZones->ThermalZone as $zone) {
			$stmt->bind_param("iss", $computer_info_id, $zone->Name, $zone->CurrentTemperature);
			$stmt->execute();
		}
		$stmt->close();
		$conn->close();

		if (file_exists($filepath)) {
			unlink($filepath);
			echo "A fájl törölve lett: $filepath";
		} else {
			echo "A fájl nem létezik: $filepath";
		}

		echo "Adatok sikeresen beillesztve az adatbázisba.";
	} else {
		echo "Az XML fájl nem létezik: $filepath";
	}
}
?>
