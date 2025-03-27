<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Data\{
    dCombined
};

use Samples\{
    sCard
    ,sTables
    ,sTranslate
    ,sForm
    ,sFrame
};

class sPerformance
{
    protected static $dCombined;
    
    const RETURN_PATH=array( 'Storage' => array('x' => 'Performance', 'y' => 'Laptop'));
    
    protected static function setDCombined(){ self::$dCombined = new dCombined();}
    
	public static function Action(array $array): string
	{
	    $array['defaultData'] = self::FORMDATA[$array['y']];
		$array['origo'] = self::TYPES[$array['y']]['origo'].$array['z'];
		$array['returnPath'] = self::RETURN_PATH[$array['y']];
		$returnContent = self::{$array['z']}($array);
		
		if (Valid::vString($returnContent)) {
			$returnContent = '<div class="text-center justification-centered">'.$returnContent.'</div>';
		}
		
		return $returnContent;
    }
    
    //Nincs használatban
    public static function Page(array $array): string
    {
        $returnString = '';
		
		if (isset($array['path'])) {
			$returnString .= sCard::Collapsible(sTranslate::Info($array['path']));
		}
        $returnString .= "PAGE";
        return $returnString;
    }

    public static function LaptopPage(array $array): string
    {
        self::setDCombined();
        $returnString = '';

        // Adatok lekérdezése
        $ComputerInfo_All = self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), 'ComputerInfo_All');
        $ProcessorInfo_All = self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), 'ProcessorInfo_All');
        $MemoryModulInfo_All = self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), 'MemoryModulInfo_All');
        $DiskDriveInfo_All = self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), 'DiskDriveInfo_All');
        $LogicalDiskInfo_All = self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), 'LogicalDiskInfo_All');
        $NetworkAdapterInfo_All = self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), 'NetworkAdapterInfo_All');
        $NetworkConnectionInfo_All = self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), 'NetworkConnectionInfo_All');
        $BIOSInfo_All = self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), 'BIOSInfo_All');
        $VolumeInfo_All = self::$dCombined->Select(array('userId' => $GLOBALS['sessionId']), 'VolumeInfo_All');
        
        // Adatok rendezése computer_name alapján
        $laptopData = array();

        foreach ($ComputerInfo_All as $data) {
            $computer_name = $data['computer_name'];
            if (!isset($laptopData[$computer_name])) {
                $laptopData[$computer_name] = array(
                    'computer_info' => array(),
                    'processors' => array(),
                    'memory_modules' => array(),
                    'disk_drives' => array(),
                    'logical_disks' => array(),
                    'network_adapters' => array(),
                    'bios' => array(),
                    'volumes' => array()
                );
            }
            $laptopData[$computer_name]['computer_info'][] = $data;
            foreach ($ProcessorInfo_All as $processors) { $laptopData[$computer_name]['processors'][] = $processors;}
            foreach ($MemoryModulInfo_All as $memory_modules) {$laptopData[$computer_name]['memory_modules'][] = $memory_modules;}
            foreach ($DiskDriveInfo_All as $disk_drives) { $laptopData[$computer_name]['disk_drives'][] = $disk_drives;}
            foreach ($LogicalDiskInfo_All as $logical_disks) {$laptopData[$computer_name]['logical_disks'][] = $logical_disks;}
            foreach ($NetworkAdapterInfo_All as $network_adapters) {$laptopData[$computer_name]['network_adapters'][] = $network_adapters;}
            foreach ($BIOSInfo_All as $bios) {$laptopData[$computer_name]['bios'][] = $bios;}
            foreach ($VolumeInfo_All as $volumes) {
                $computer_name = $data['computer_name'];
                $drive_letter = $volumes['drive_letter'];
                $allocation_unit_size = $volumes['allocation_unit_size'];
                $volume_id = $drive_letter . "_" . $allocation_unit_size;
                if (!isset($laptopData[$computer_name]['volumes'][$volume_id])) {
                    $laptopData[$computer_name]['volumes'][$volume_id] = array();
                }
                $laptopData[$computer_name]['volumes'][$volume_id][] = $volumes;}
        }

        // Adatok kiírása JavaScript formátumban
        $jsonLaptopData = json_encode($laptopData);
        $returnString .= "<script>let laptopData = $jsonLaptopData;</script>";

        // Diagramok létrehozása
        foreach ($laptopData as $computer_name => $data) {
            
            // Nem olvasott be értéket
            $networkReceivedBytesData = array();
            $networkSentBytesData = array();
            $cpuLoadData = array();
            $memoryLoadData = array();
            $diskLoadData = array();
            $diskFreeSpaceData = array();
            
            // Működik
            $clockSpeedData = array();
            $volumeData = array();
            $logicalDiskData = array();
            $diskUsedSpaceData = array();
            $memoryCapacityData = array();

            // Perpill üres, frissíteni kell a PS1-et
            /*
            foreach ($data['computer_info'] as $record) {
                $timestamp = strtotime($record['timestamp']);
                $cpuLoadData[] = array('x' => $timestamp, 'y' => isset($record['cpu_load']) ? $record['cpu_load'] : 0);
                $memoryLoadData[] = array('x' => $timestamp, 'y' => isset($record['memory_load']) ? $record['memory_load'] : 0);
                $diskLoadData[] = array('x' => $timestamp, 'y' => isset($record['disk_load']) ? $record['disk_load'] : 0);
            }
            */
            foreach ($data['memory_modules'] as $record) {
                $timestamp = strtotime($record['timestamp']);
                $memoryCapacityData[] = array('x' => $timestamp, 'y' => isset($record['capacity']) ? $record['capacity'] : 0);
            }
            
            // Perpill a diskFreeSpaceData üres, frissíteni kell a PS1-et
            foreach ($data['disk_drives'] as $record) {
                $timestamp = strtotime($record['timestamp']);
                $diskUsedSpaceData[] = array('x' => $timestamp, 'y' => isset($record['used_space']) ? $record['used_space'] : 0);
                $diskFreeSpaceData[] = array('x' => $timestamp, 'y' => isset($record['free_space']) ? $record['free_space'] : 0);
            }

            // Perpill üres, frissíteni kell a PS1-et
            foreach ($data['network_adapters'] as $record) {
                $timestamp = strtotime($record['timestamp']);
                $networkReceivedBytesData[] = array('x' => $timestamp, 'y' => isset($record['received_bytes']) ? $record['received_bytes'] : 0);
                $networkSentBytesData[] = array('x' => $timestamp, 'y' => isset($record['sent_bytes']) ? $record['sent_bytes'] : 0);
            }
            
            // Processors kész
            foreach ($data['processors'] as $record) {
                $timestamp = strtotime($record['timestamp']);
                $clockSpeedData['current'][] = array('x' => $timestamp, 'y' => isset($record['current_clock_speed']) ? $record['current_clock_speed'] : 0);
                $clockSpeedData['max'][] = array('x' => $timestamp, 'y' => isset($record['max_clock_speed']) ? $record['max_clock_speed'] : 0);
            }

            // Volume Data kész
            foreach ($data['volumes'] as $volume_id => $volumeRecords) {
                $volumeSizeRemainingData = array();
                $volumeSizeData = array();
                foreach ($volumeRecords as $record) {
                    $timestamp = strtotime($record['timestamp']);
                    $volumeSizeRemainingData[] = array('x' => $timestamp, 'y' => isset($record['size_remaining']) ? $record['size_remaining'] : 0);
                    $volumeSizeData[] = array('x' => $timestamp, 'y' => isset($record['size']) ? $record['size'] : 0);
                }
                $volumeData[$volume_id]['remaining'] = $volumeSizeRemainingData;
                $volumeData[$volume_id]['size'] = $volumeSizeData;
            }
            // Logical Disk kész
            foreach ($data['logical_disks'] as $record) {
                $timestamp = strtotime($record['timestamp']);
                $logicalDiskData['free_space'][] = array('x' => $timestamp, 'y' => isset($record['free_space']) ? $record['free_space'] : 0);
                $logicalDiskData['size'][] = array('x' => $timestamp, 'y' => isset($record['size']) ? $record['size'] : 0);
            }

            $returnString .= "<h3>Laptop Information for Computer: $computer_name</h3><br />";
            $returnString .= "<div class='chart-container-wrapper'>";

            $returnString .= "<table id='laptopPerfData' border='1' style='width: 45%; margin: 10px 0; padding: 10px; box-sizing: border-box;'>";
            $returnString .= "<tr><th>Computer Name</th><td>" . (isset($data['computer_info'][0]['computer_name']) ? $data['computer_info'][0]['computer_name'] : 'N/A') . "</td></tr>";
            $returnString .= "<tr><th>Manufacturer</th><td>" . (isset($data['computer_info'][0]['manufacturer']) ? $data['computer_info'][0]['manufacturer'] : 'N/A') . "</td></tr>";
            $returnString .= "<tr><th>Model</th><td>" . (isset($data['computer_info'][0]['model']) ? $data['computer_info'][0]['model'] : 'N/A') . "</td></tr>";
            $returnString .= "<tr><th>Total Physical Memory</th><td>" . (isset($data['computer_info'][0]['total_physical_memory']) ? $data['computer_info'][0]['total_physical_memory'] : 'N/A') . "</td></tr>";
            $returnString .= "<tr><th>Operating System</th><td>" . (isset($data['computer_info'][0]['os_caption']) && isset($data['computer_info'][0]['os_version']) && isset($data['computer_info'][0]['os_build_number']) ? "{$data['computer_info'][0]['os_caption']} ({$data['computer_info'][0]['os_version']}, Build {$data['computer_info'][0]['os_build_number']})" : 'N/A') . "</td></tr>";
            $returnString .= "<tr><th>BIOS Version</th><td>" . (isset($data['bios'][0]['version']) ? $data['bios'][0]['version'] : 'N/A') . "</td></tr>";
            $returnString .= "<tr><th>Processor Name</th><td>" . (isset($data['processors'][0]['name']) ? $data['processors'][0]['name'] : 'N/A') . "</td></tr>";
            $returnString .= "<tr><th>Processor Manufacturer</th><td>" . (isset($data['processors'][0]['manufacturer']) ? $data['processors'][0]['manufacturer'] : 'N/A') . "</td></tr>";
            $returnString .= "<tr><th>Processor Number of Cores</th><td>" . (isset($data['processors'][0]['number_of_cores']) ? $data['processors'][0]['number_of_cores'] : 'N/A') . "</td></tr>";
            $returnString .= "<tr><th>Number of Logical Processors</th><td>" . (isset($data['processors'][0]['number_of_logical_processors']) ? $data['processors'][0]['number_of_logical_processors'] : 'N/A') . "</td></tr>";
            $returnString .= "</table>";

            // Diagramok létrehozása
            // CPU, Memory, Disk Load - kész
            /*
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='CPU, Memory, Disk Load' id='loadData$computer_name'>" . json_encode(array(
                array('name' => 'CPU Load', 'type' => 'line', 'dataPoints' => $cpuLoadData),
                array('name' => 'Memory Load', 'type' => 'line', 'dataPoints' => $memoryLoadData),
                array('name' => 'Disk Load', 'type' => 'line', 'dataPoints' => $diskLoadData)
            )) . "</div>";
            */
            // Memory Module Capacity - kész
            $returnString .= "<div class='chartContainer' data-chart-type='line' data-label='Memory Module Capacity' id='memoryCapacity$computer_name'>" . json_encode(array(
                array('name' => 'Memory Module Capacity', 'type' => 'line', 'dataPoints' => $memoryCapacityData)
            )) . "</div>";

            // Disk Drive Used and Free Space - Kész
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Disk Drive Used and Free Space' id='diskSpace$computer_name'>" . json_encode(array(
                array('name' => 'Used Space', 'type' => 'line', 'dataPoints' => $diskUsedSpaceData),
                array('name' => 'Free Space', 'type' => 'line', 'dataPoints' => $diskFreeSpaceData)
            )) . "</div>";

            // Network Adapter Performance - Kész
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Network Adapter Performance' id='networkPerformance$computer_name'>" . json_encode(array(
                array('name' => 'Received Bytes', 'type' => 'line', 'dataPoints' => $networkReceivedBytesData),
                array('name' => 'Sent Bytes', 'type' => 'line', 'dataPoints' => $networkSentBytesData)
            )) . "</div>";

            // Current Clock Speed - kész
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Current Clock Speed' id='currentClockSpeed$computer_name'>" . json_encode(array(
                array('name' => 'Current Clock Speed', 'type' => 'area', 'dataPoints' => $clockSpeedData['current'])
                ,array('name' => 'Max Clock Speed', 'type' => 'line', 'dataPoints' => $clockSpeedData['max'])
            )) . "</div>";
            
            // Volume Size Remaining - kész
            foreach ($volumeData as $volume_id => $volumeSizeDatas) {
                $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Volume Size Remaining (Volume $volume_id)' id='volumeSizeRemaining{$computer_name}_$volume_id'>" . json_encode(array(
                    array('name' => 'Size Remaining', 'type' => 'area', 'dataPoints' => $volumeData[$volume_id]['remaining'])
                    ,array('name' => 'Size', 'type' => 'line', 'dataPoints' => $volumeData[$volume_id]['size'])
                )) . "</div>";
            }
            
            // Logical Disk Data - kész
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Logical Disk Data' id='logicalDiskData$computer_name'>" . json_encode(array(
                array('name' => 'Logical Free Space', 'type' => 'area', 'dataPoints' => $logicalDiskData['free_space'])
                ,array('name' => 'Logical Size', 'type' => 'line', 'dataPoints' => $logicalDiskData['size'])
            )) . "</div>";
           
            $returnString .= "</div>";
        }
        
        return $returnString;
    }
}
?>