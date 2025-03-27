# Kapacitás és teljesítmény információk gyűjtése
Try {
    Write-Host "Retrieving ComputerSystem info..."
    $computerSystem = Get-WmiObject -Class Win32_ComputerSystem
    Write-Host "Successfully retrieved ComputerSystem info"
    
    Write-Host "Retrieving Processor info..."
    $processor = Get-WmiObject -Class Win32_Processor
    Write-Host "Successfully retrieved Processor info"
    
    Write-Host "Retrieving PhysicalMemory info..."
    $physicalMemory = Get-WmiObject -Class Win32_PhysicalMemory
    Write-Host "Successfully retrieved PhysicalMemory info"
    
    Write-Host "Retrieving DiskDrives info..."
    $diskDrives = Get-WmiObject -Class Win32_DiskDrive
    Write-Host "Successfully retrieved DiskDrives info"
    
    Write-Host "Retrieving LogicalDisks info..."
    $logicalDisks = Get-WmiObject -Class Win32_LogicalDisk
    Write-Host "Successfully retrieved LogicalDisks info"
    
    Write-Host "Retrieving OperatingSystem info..."
    $os = Get-WmiObject -Class Win32_OperatingSystem
    Write-Host "Successfully retrieved OperatingSystem info"
    
    Write-Host "Retrieving NetworkAdapters info..."
    $networkAdapters = Get-WmiObject -Class Win32_NetworkAdapter -Filter "NetEnabled=True"
    Write-Host "Successfully retrieved NetworkAdapters info"
    
    Write-Host "Retrieving BIOS info..."
    $bios = Get-WmiObject -Class Win32_BIOS
    Write-Host "Successfully retrieved BIOS info"
    
    Write-Host "Retrieving Volumes info..."
    $volumes = Get-Volume
    Write-Host "Successfully retrieved Volumes info"
    
    Write-Host "Retrieving Network Connections info..."
    $networkConnections = Get-WmiObject -Class Win32_NetworkAdapterConfiguration -Filter "IPEnabled=True"
    Write-Host "Successfully retrieved Network Connections info"
    
    Write-Host "Retrieving Motherboard info..."
    $motherboard = Get-WmiObject -Class Win32_BaseBoard
    Write-Host "Successfully retrieved Motherboard info"
} Catch {
    Write-Host "Error: $_"
}

# XML struktúra létrehozása
Try {
    Write-Host "Creating XML structure..."
    $xmlContent = @"
<ComputerInfo>
    <ComputerSystem>
        <Name>$($computerSystem.Name)</Name>
        <Manufacturer>$($computerSystem.Manufacturer)</Manufacturer>
        <Model>$($computerSystem.Model)</Model>
        <TotalPhysicalMemory>$($computerSystem.TotalPhysicalMemory)</TotalPhysicalMemory>
    </ComputerSystem>
    <Processors>
"@
    foreach ($cpu in $processor) {
        $xmlContent += "<Processor>"
        $xmlContent += "<Name>$($cpu.Name)</Name>"
        $xmlContent += "<Manufacturer>$($cpu.Manufacturer)</Manufacturer>"
        $xmlContent += "<MaxClockSpeed>$($cpu.MaxClockSpeed)</MaxClockSpeed>"
        $xmlContent += "<CurrentClockSpeed>$($cpu.CurrentClockSpeed)</CurrentClockSpeed>"
        $xmlContent += "<NumberOfCores>$($cpu.NumberOfCores)</NumberOfCores>"
        $xmlContent += "<NumberOfLogicalProcessors>$($cpu.NumberOfLogicalProcessors)</NumberOfLogicalProcessors>"
        $xmlContent += "</Processor>"
    }
    $xmlContent += "</Processors>"
    
    $xmlContent += "<MemoryModules>"
    foreach ($memory in $physicalMemory) {
        $xmlContent += "<MemoryModule>"
        $xmlContent += "<Capacity>$($memory.Capacity)</Capacity>"
        $xmlContent += "<Speed>$($memory.Speed)</Speed>"
        $xmlContent += "<Manufacturer>$($memory.Manufacturer)</Manufacturer>"
        $xmlContent += "<SerialNumber>$($memory.SerialNumber)</SerialNumber>"
        $xmlContent += "</MemoryModule>"
    }
    $xmlContent += "</MemoryModules>"
    
    $xmlContent += "<DiskDrives>"
    foreach ($disk in $diskDrives) {
        $xmlContent += "<DiskDrive>"
        $xmlContent += "<Model>$($disk.Model)</Model>"
        $xmlContent += "<Size>$($disk.Size)</Size>"
        $xmlContent += "<FreeSpace>$($disk.FreeSpace)</FreeSpace>"
        $xmlContent += "<UsedSpace>$(($disk.Size - $disk.FreeSpace))</UsedSpace>"
        $fragmentationLevel = ""
        $blockSize = ""
        $driveLetter = ($logicalDisks | Where-Object { $_.DeviceID -eq $disk.DeviceID }).Name
        if ($driveLetter) {
            Try {
                $volume = Get-Volume -DriveLetter $driveLetter
                $fragmentationLevel = $volume.PercentFragmentation
                $blockSize = $volume.AllocationUnitSize
            } Catch {
                Write-Host "No MSFT_Volume objects found with property 'DriveLetter' equal to '$($driveLetter)'."
            }
        } else {
            Write-Host "No LogicalDisk found with DeviceID equal to '$($disk.DeviceID)'."
        }
        $xmlContent += "<FragmentationLevel>$fragmentationLevel</FragmentationLevel>"
        $xmlContent += "<BlockSize>$blockSize</BlockSize>"
        $xmlContent += "</DiskDrive>"
    }
    $xmlContent += "</DiskDrives>"

    $xmlContent += "<LogicalDisks>"
    foreach ($disk in $logicalDisks) {
        $xmlContent += "<LogicalDisk>"
        $xmlContent += "<Name>$($disk.Name)</Name>"
        $xmlContent += "<FreeSpace>$($disk.FreeSpace)</FreeSpace>"
        $xmlContent += "<Size>$($disk.Size)</Size>"
        $xmlContent += "</LogicalDisk>"
    }
    $xmlContent += "</LogicalDisks>"

    # Teszt eleje --------------------------------------------------------------------
    
    $xmlContent += "<NetworkAdapters>"
    foreach ($adapter in $networkAdapters) {
        $xmlContent += "<NetworkAdapter>"
        $xmlContent += "<Name>$($adapter.Name)</Name>"
        $xmlContent += "<MACAddress>$($adapter.MACAddress)</MACAddress>"
        $xmlContent += "<Speed>$($adapter.Speed)</Speed>"
        # Placeholder values for Network Performance Data
        $xmlContent += "<ReceivedBytes>0</ReceivedBytes>"
        $xmlContent += "<SentBytes>0</SentBytes>"
        $xmlContent += "</NetworkAdapter>"
    }
    $xmlContent += "</NetworkAdapters>"

    $xmlContent += "<BIOS>"
    $xmlContent += "<Manufacturer>$($bios.Manufacturer)</Manufacturer>"
    $xmlContent += "<Version>$($bios.Version)</Version>"
    $xmlContent += "<ReleaseDate>$($bios.ReleaseDate)</ReleaseDate>"
    $xmlContent += "</BIOS>"

    $xmlContent += "<Volumes>"
    foreach ($volume in $volumes) {
        $xmlContent += "<Volume>"
        $xmlContent += "<DriveLetter>$($volume.DriveLetter)</DriveLetter>"
        $xmlContent += "<FileSystem>$($volume.FileSystem)</FileSystem>"
        $xmlContent += "<SizeRemaining>$($volume.SizeRemaining)</SizeRemaining>"
        $xmlContent += "<Size>$($volume.Size)</Size>"
        $xmlContent += "<PercentFragmentation>$($volume.PercentFragmentation)</PercentFragmentation>"
        $xmlContent += "<AllocationUnitSize>$($volume.AllocationUnitSize)</AllocationUnitSize>"
        $xmlContent += "</Volume>"
    }
    $xmlContent += "</Volumes>"

    $xmlContent += "<NetworkConnections>"
    foreach ($connection in $networkConnections) {
        $xmlContent += "<NetworkConnection>"
        $xmlContent += "<Description>$($connection.Description)</Description>"
        $xmlContent += "<IPAddress>$($connection.IPAddress)</IPAddress>"
        $xmlContent += "<MACAddress>$($connection.MACAddress)</MACAddress>"
        $xmlContent += "</NetworkConnection>"
    }
    $xmlContent += "</NetworkConnections>"

    $xmlContent += "<Motherboard>"
    $xmlContent += "<Manufacturer>$($motherboard.Manufacturer)</Manufacturer>"
    $xmlContent += "<Product>$($motherboard.Product)</Product>"
    $xmlContent += "<SerialNumber>$($motherboard.SerialNumber)</SerialNumber>"
    $xmlContent += "</Motherboard>"

    $cpuLoad = $null
    $memoryLoad = $null
    $diskLoad = $null

    Try {
        Write-Host "Retrieving CPU Load..."
        $cpuLoad = Get-Counter '\Processor(_Total)\% Processor Time'
        Write-Host "CPU Load retrieved successfully."
    } Catch {
        Write-Host "Error retrieving CPU Load: $_"
        $cpuLoad = @{ CounterSamples = @(@{ CookedValue = 0 }) }
    }

    Try {
        Write-Host "Retrieving Memory Load..."
        $memoryLoad = Get-Counter '\Memory\% Committed Bytes In Use'
        Write-Host "Memory Load retrieved successfully."
    } Catch {
        Write-Host "Error retrieving Memory Load: $_"
        $memoryLoad = @{ CounterSamples = @(@{ CookedValue = 0 }) }
    }

    Try {
        Write-Host "Retrieving Disk Load..."
        $diskLoad = Get-Counter '\PhysicalDisk(_Total)\% Disk Time'
        Write-Host "Disk Load retrieved successfully."
    } Catch {
        Write-Host "Error retrieving Disk Load: $_"
        $diskLoad = @{ CounterSamples = @(@{ CookedValue = 0 }) }
    }

    Try {
        Write-Host "Retrieving Network Performance Data..."
        $networkPerformanceData = Get-NetAdapterStatistics
        Write-Host "Network Performance Data retrieved successfully."
    } Catch {
        Write-Host "Error retrieving Network Performance Data: $_"
        $networkPerformanceData = @()
    }

    # Ensure that CpuLoad, MemoryLoad, and DiskLoad have a valid value
    $cpuLoadValue = if ($cpuLoad -and $cpuLoad.CounterSamples) { $cpuLoad.CounterSamples[0].CookedValue } else { 0 }
    $memoryLoadValue = if ($memoryLoad -and $memoryLoad.CounterSamples) { $memoryLoad.CounterSamples[0].CookedValue } else { 0 }
    $diskLoadValue = if ($diskLoad -and $diskLoad.CounterSamples) { $diskLoad.CounterSamples[0].CookedValue } else { 0 }

    $xmlContent += "<Performance>"
    $xmlContent += "<CpuLoad>$cpuLoadValue</CpuLoad>"
    $xmlContent += "<MemoryLoad>$memoryLoadValue</MemoryLoad>"
    $xmlContent += "<DiskLoad>$diskLoadValue</DiskLoad>"
    $xmlContent += "</Performance>"

    $xmlContent += "<OperatingSystem>"
    $xmlContent += "<Caption>$($os.Caption)</Caption>"
    $xmlContent += "<Version>$($os.Version)</Version>"
    $xmlContent += "<BuildNumber>$($os.BuildNumber)</BuildNumber>"
    $xmlContent += "</OperatingSystem>"

    $xmlContent += "<NetworkPerformance>"
    foreach ($adapter in $networkAdapters) {
        $receivedBytes = 0
        $sentBytes = 0
        if ($networkPerformanceData) {
            $adapterData = $networkPerformanceData | Where-Object { $_.Name -eq $adapter.Name }
            if ($adapterData) {
                $receivedBytes = $adapterData.ReceivedBytes
                $sentBytes = $adapterData.SentBytes
            }
        }
        $xmlContent += "<Adapter>"
        $xmlContent += "<Name>$($adapter.Name)</Name>"
        $xmlContent += "<MACAddress>$($adapter.MACAddress)</MACAddress>"
        $xmlContent += "<Speed>$($adapter.Speed)</Speed>"
        $xmlContent += "<ReceivedBytes>$receivedBytes</ReceivedBytes>"
        $xmlContent += "<SentBytes>$sentBytes</SentBytes>"
        $xmlContent += "</Adapter>"
    }
    $xmlContent += "</NetworkPerformance>"

	$xmlContent += "</ComputerInfo>"

    # Fájlnév beállítása timestamp-pel ellátva
    Write-Host "Saving XML file..."
    $timestamp = Get-Date -Format "yyyyMMddHHmmss"
    $filePath = "C:\Development\XAMPP\htdocs\public_html\capmng\import\ComputerInfo_$timestamp.xml"

    # XML fájl mentése
    $xmlContent | Out-File -FilePath $filePath -Encoding utf8
    Write-Host "Successfully saved XML file at $filePath"
    Write-Host "ExitCode001"
} Catch {
    Write-Host "Error while creating or saving XML file: $_"
}
