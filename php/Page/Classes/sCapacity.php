<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

use Data\{
    dStorageId
    ,dStoragePhys
    ,dStorageTotal
    ,dStorageGroup
};

use Samples\{
    sCard
    ,sTables
    ,sTranslate
    ,sForm
    ,sFrame
};

class sCapacity
{
    protected static $dStorageId;
    protected static $dStoragePhys;
    protected static $dStorageTotal;
    protected static $dStorageGroup;
    
    const RETURN_PATH=array( 'Storage' => array('x' => 'Capacity', 'y' => 'Storage'));
    
    protected static function setDStorageId(){ self::$dStorageId = new dStorageId();}
    protected static function setDStoragePhys(){ self::$dStoragePhys = new dStoragePhys();}
    protected static function setDStorageTotal(){ self::$dStorageTotal = new dStorageTotal();}
    protected static function setDStorageGroup(){ self::$dStorageGroup = new dStorageGroup();}
    
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
    
   public static function StoragePage(array $array): string
    {
        self::setDStorageTotal();
        $returnString = '';

        // Adatok lekérdezése
        $fClass = self::$dStorageTotal->Select(array('userId' => $GLOBALS['sessionId']), 'All');
       
        // Adatok rendezése storage_id alapján
        $storageData = array();
        foreach ($fClass as $data) {
            $storage_id = $data['storage_id'];
            if (!isset($storageData[$storage_id])) {
                $storageData[$storage_id] = array();
            }
            $storageData[$storage_id][] = $data;
        }

        // Adatok kiírása JavaScript formátumban
        $jsonStorageData = json_encode($storageData);
        $returnString .= "<script>let storageData = $jsonStorageData;</script>";

        // Diagramok létrehozása
        foreach ($storageData as $storage_id => $records) {
            $sym_id = $records[0]['sym_id'];
            $srp_name = $records[0]['srp_name'];

            // Adatok előkészítése
            $physicalCapacityData = array();
            $usableCapacityData = array();
            $snapshotEffectiveCapacityData = array();
            $srdfDseAllocatedData = array();
            $snapshotsAllocatedData = array();
            $compressionRatioData = array();
            $dataReductionRatioData = array();
            $totalSubscribedPctData = array();
            $provisionedCapacityData = array();
            $subscribedCapacityData = array();
            $effectiveUsedData = array();
            $effectiveUsedPctData = array();
            $allocatedCapacityData = array();
            $allocatedCapacityPctData = array();
            $physicalUsedData = array();
            $usedCapacityData = array();
            $unreducibleUsedCapData = array();
            $snapEffectiveUsedData = array();
            $snapCapacityData = array();
            $snapPhysicalUsedData = array();
            $snapUsedCapacityData = array();
            $snapUnreducibleUsedCapData = array();
            $compressionSnapshotRatioData = array();

            foreach ($records as $record) {
                $timestamp = strtotime($record['insert_date']);
                $physicalCapacityData[] = array('x' => $timestamp, 'y' => $record['physical_capacity']);
                $usableCapacityData[] = array('x' => $timestamp, 'y' => $record['usable_capacity']);
                $snapshotEffectiveCapacityData[] = array('x' => $timestamp, 'y' => $record['snapshot_effective_capacity']);
                $srdfDseAllocatedData[] = array('x' => $timestamp, 'y' => $record['srdf_dse_allocated']);
                $snapshotsAllocatedData[] = array('x' => $timestamp, 'y' => $record['snapshots_allocated']);
                $compressionRatioData[] = array('x' => $timestamp, 'y' => floatval($record['compression_ratio']));
                $dataReductionRatioData[] = array('x' => $timestamp, 'y' => floatval($record['storagePhys_data_reduction_ratio']));
                $totalSubscribedPctData[] = array('x' => $timestamp, 'y' => floatval($record['total_subscribed_pct']));
                $provisionedCapacityData[] = array('x' => $timestamp, 'y' => $record['provisioned_capacity']);
                $subscribedCapacityData[] = array('x' => $timestamp, 'y' => $record['subscribed_capacity']);
                $effectiveUsedData[] = array('x' => $timestamp, 'y' => $record['effective_used']);
                $effectiveUsedPctData[] = array('x' => $timestamp, 'y' => $record['effective_used_pct']);
                $allocatedCapacityData[] = array('x' => $timestamp, 'y' => $record['allocated_capacity']);
                $allocatedCapacityPctData[] = array('x' => $timestamp, 'y' => $record['allocated_capacity_pct']);
                $physicalUsedData[] = array('x' => $timestamp, 'y' => $record['physical_used']);
                $usedCapacityData[] = array('x' => $timestamp, 'y' => $record['used_capacity']);
                $unreducibleUsedCapData[] = array('x' => $timestamp, 'y' => $record['unreducible_used_cap']);
                $snapEffectiveUsedData[] = array('x' => $timestamp, 'y' => $record['snap_effective_used']);
                $snapCapacityData[] = array('x' => $timestamp, 'y' => $record['snap_capacity']);
                $snapPhysicalUsedData[] = array('x' => $timestamp, 'y' => $record['snap_physical_used']);
                $snapUsedCapacityData[] = array('x' => $timestamp, 'y' => $record['snap_used_capacity']);
                $snapUnreducibleUsedCapData[] = array('x' => $timestamp, 'y' => $record['snap_unreducible_used_cap']);
                $compressionSnapshotRatioData[] = array('x' => $timestamp, 'y' => floatval($record['compression_snapshot_ratio']));
            }

            $returnString .= "<button class='collapsible specheader'><h3>$sym_id - $srp_name</h3></button>";
            $returnString .= "<div class='chart-container-wrapper collapsible-content'>";

            // 1. diagramm: Physical and Usable Capacity
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Physical and Usable Capacity' id='physicalUsableCapacity$storage_id'>" . json_encode(array(
                array('name' => 'Physical Capacity', 'type' => 'line', 'dataPoints' => $physicalCapacityData),
                array('name' => 'Usable Capacity', 'type' => 'line', 'dataPoints' => $usableCapacityData)
            )) . "</div>";

            // 2. diagramm: Snapshot Effective Capacity, SRDF DSE Allocated, Snapshots Allocated
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Snapshot Effective Capacity, SRDF DSE Allocated, Snapshots Allocated' id='snapshotEffectiveCapacity$storage_id'>" . json_encode(array(
                array('name' => 'Snapshot Effective Capacity', 'type' => 'line', 'dataPoints' => $snapshotEffectiveCapacityData),
                array('name' => 'SRDF DSE Allocated', 'type' => 'area', 'dataPoints' => $srdfDseAllocatedData),
                array('name' => 'Snapshots Allocated', 'type' => 'area', 'dataPoints' => $snapshotsAllocatedData)
            )) . "</div>";

            // 3. diagramm: Compression Ratio, Data Reduction Ratio, Total Subscribed Percentage
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Compression Ratio, Data Reduction Ratio, Total Subscribed Percentage' id='compressionData$storage_id'>" . json_encode(array(
                array('name' => 'Compression Ratio', 'type' => 'column', 'dataPoints' => $compressionRatioData),
                array('name' => 'Data Reduction Ratio', 'type' => 'column', 'dataPoints' => $dataReductionRatioData),
                array('name' => 'Total Subscribed Percentage', 'type' => 'line', 'dataPoints' => $totalSubscribedPctData)
            )) . "</div>";

            // 4. diagramm: Provisioned and Subscribed Capacity
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Provisioned and Subscribed Capacity' id='provisionedSubscribedCapacity$storage_id'>" . json_encode(array(
                array('name' => 'Provisioned Capacity', 'type' => 'line', 'dataPoints' => $provisionedCapacityData),
                array('name' => 'Subscribed Capacity', 'type' => 'line', 'dataPoints' => $subscribedCapacityData)
            )) . "</div>";

            // 5. diagramm: Effective Used and Allocated Capacity
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Effective Used and Allocated Capacity' id='effectiveAllocatedCapacity$storage_id'>" . json_encode(array(
                array('name' => 'Effective Used', 'type' => 'line', 'dataPoints' => $effectiveUsedData),
                array('name' => 'Effective Used Percentage', 'type' => 'line', 'dataPoints' => $effectiveUsedPctData),
                array('name' => 'Allocated Capacity', 'type' => 'line', 'dataPoints' => $allocatedCapacityData),
                array('name' => 'Allocated Capacity Percentage', 'type' => 'line', 'dataPoints' => $allocatedCapacityPctData)
            )) . "</div>";
            
            // 6. diagramm: Physical Used and Used Capacity
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Physical Used and Used Capacity' id='physicalUsedCapacity$storage_id'>" . json_encode(array(
                array('name' => 'Physical Used', 'type' => 'line', 'dataPoints' => $physicalUsedData),
                array('name' => 'Used Capacity', 'type' => 'line', 'dataPoints' => $usedCapacityData)
            )) . "</div>";

            // 7. diagramm: Unreducible Used Capacity
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Unreducible Used Capacity' id='unreducibleUsedCapacity$storage_id'>" . json_encode(array(
                array('name' => 'Unreducible Used Capacity', 'type' => 'line', 'dataPoints' => $unreducibleUsedCapData)
            )) . "</div>";

            // 8. diagramm: Snapshot Effective Used, Snapshot Capacity, Snapshot Physical Used, Snapshot Used Capacity, Snapshot Unreducible Used Cap
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Snapshot Data' id='snapshotData$storage_id'>" . json_encode(array(
                array('name' => 'Snapshot Effective Used', 'type' => 'line', 'dataPoints' => $snapEffectiveUsedData),
                array('name' => 'Snapshot Capacity', 'type' => 'line', 'dataPoints' => $snapCapacityData),
                array('name' => 'Snapshot Physical Used', 'type' => 'line', 'dataPoints' => $snapPhysicalUsedData),
                array('name' => 'Snapshot Used Capacity', 'type' => 'line', 'dataPoints' => $snapUsedCapacityData),
                array('name' => 'Snapshot Unreducible Used Capacity', 'type' => 'line', 'dataPoints' => $snapUnreducibleUsedCapData)
            )) . "</div>";

            // 9. diagramm: Compression Snapshot Ratio
            $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Compression Snapshot Ratio' id='compressionSnapshotRatio$storage_id'>" . json_encode(array(
                array('name' => 'Compression Snapshot Ratio', 'type' => 'line', 'dataPoints' => $compressionSnapshotRatioData)
            )) . "</div>";

            $returnString .= "</div>";
        }
       
        return $returnString;
    }
    
    public static function GroupPage(array $array): string
    {
        self::setDStorageGroup();
        $returnString = '';

        // Adatok lekérdezése
        $fClass = self::$dStorageGroup->Select(array('userId' => $GLOBALS['sessionId']), 'All');

        // Adatok rendezése srp_name és group_name alapján
        $storageData = array();
        foreach ($fClass as $data) {
            if (isset($data['srp_name']) && isset($data['group_name'])) {
                $srp_name = $data['srp_name'];
                $group_name = $data['group_name'];
                if (!isset($storageData[$srp_name])) {
                    $storageData[$srp_name] = array();
                }
                if (!isset($storageData[$srp_name][$group_name])) {
                    $storageData[$srp_name][$group_name] = array();
                }
                $storageData[$srp_name][$group_name][] = $data;
            } else {
                error_log("Missing srp_name or group_name in data: " . print_r($data, true));
            }
        }

        // Adatok kiírása JavaScript formátumban
        $jsonStorageData = json_encode($storageData);
        $returnString .= "<script>let storageData = $jsonStorageData;</script>";

        // Diagramok létrehozása
        foreach ($storageData as $srp_name => $groups) {
            foreach ($groups as $group_name => $records) {
                $sym_id = $records[0]['sym_id'];

                // Adatok előkészítése diagramokhoz
                $provisionedData = array();
                $subscribedCapacityData = array();
                $userData = array();
                $userDataPercent = array();
                $totalEffectiveUsed = array();
                $totalPhysicalUsed = array();
                $totalPhysicalUsedPercent = array();
                $totalUnreducibleUsed = array();
                $totalDataReductionRatio = array();
                $effectiveUsed = array();
                $effectiveUsedPct = array();
                $allocatedCapacity = array();
                $allocatedCapacityPct = array();
                $physicalUsed = array();
                $usedCapacity = array();
                $unreducibleUsedCap = array();
                $dataReductionRatio = array();
                $compressionRatio = array();

                foreach ($records as $record) {
                    $timestamp = strtotime($record['insert_date']);
                    $provisionedData[] = array('x' => $timestamp, 'y' => $record['provisioned']);
                    $subscribedCapacityData[] = array('x' => $timestamp, 'y' => $record['subscribed_capacity']);
                    $userData[] = array('x' => $timestamp, 'y' => $record['user_data']);
                    $userDataPercent[] = array('x' => $timestamp, 'y' => $record['user_data_percent']);
                    $totalEffectiveUsed[] = array('x' => $timestamp, 'y' => $record['total_effective_used']);
                    $totalPhysicalUsed[] = array('x' => $timestamp, 'y' => $record['total_physical_used']);
                    $totalPhysicalUsedPercent[] = array('x' => $timestamp, 'y' => $record['total_physical_used_percent']);
                    $totalUnreducibleUsed[] = array('x' => $timestamp, 'y' => $record['total_unreducible_used']);
                    $totalDataReductionRatio[] = array('x' => $timestamp, 'y' => $record['total_data_reduction_ratio']);
                    $effectiveUsed[] = array('x' => $timestamp, 'y' => $record['effective_used']);
                    $effectiveUsedPct[] = array('x' => $timestamp, 'y' => $record['effective_used_pct']);
                    $allocatedCapacity[] = array('x' => $timestamp, 'y' => $record['allocated_capacity']);
                    $allocatedCapacityPct[] = array('x' => $timestamp, 'y' => $record['allocated_capacity_pct']);
                    $physicalUsed[] = array('x' => $timestamp, 'y' => $record['physical_used']);
                    $usedCapacity[] = array('x' => $timestamp, 'y' => $record['used_capacity']);
                    $unreducibleUsedCap[] = array('x' => $timestamp, 'y' => $record['unreducible_used_cap']);
                    $dataReductionRatio[] = array('x' => $timestamp, 'y' => $record['data_reduction_ratio']);
                    $compressionRatio[] = array('x' => $timestamp, 'y' => $record['compression_ratio']);
                }

                $returnString .= "<button class='collapsible specheader'><h3>$sym_id - $srp_name - $group_name</h3></button>";
                $returnString .= "<div class='chart-container-wrapper collapsible-content'>";

                // 1. diagram: Provisioned vs Subscribed Capacity
                $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Provisioned vs Subscribed Capacity' id='provisionedSubscribedCapacity$srp_name$group_name'>" . json_encode(array(
                    array('name' => 'Provisioned', 'type' => 'line', 'dataPoints' => $provisionedData),
                    array('name' => 'Subscribed Capacity', 'type' => 'line', 'dataPoints' => $subscribedCapacityData)
                )) . "</div>";

                // 2. diagram: User Data and User Data Percent
                $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='User Data and User Data Percent' id='userData$srp_name$group_name'>" . json_encode(array(
                    array('name' => 'User Data', 'type' => 'line', 'dataPoints' => $userData),
                    array('name' => 'User Data Percent', 'type' => 'line', 'dataPoints' => $userDataPercent)
                )) . "</div>";

                // 3. diagram: Total Effective Used and Total Physical Used
                $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Total Effective Used and Total Physical Used' id='totalEffectivePhysicalUsed$srp_name$group_name'>" . json_encode(array(
                    array('name' => 'Total Effective Used', 'type' => 'line', 'dataPoints' => $totalEffectiveUsed),
                    array('name' => 'Total Physical Used', 'type' => 'line', 'dataPoints' => $totalPhysicalUsed)
                )) . "</div>";

                // 4. diagram: Total Physical Used Percent and Total Unreducible Used
                $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Total Physical Used Percent and Total Unreducible Used' id='totalPhysicalUsedPercent$srp_name$group_name'>" . json_encode(array(
                    array('name' => 'Total Physical Used Percent', 'type' => 'line', 'dataPoints' => $totalPhysicalUsedPercent),
                    array('name' => 'Total Unreducible Used', 'type' => 'line', 'dataPoints' => $totalUnreducibleUsed)
                )) . "</div>";

                // 5. diagram: Data Reduction Ratio and Compression Ratio
                $returnString .= "<div class='chartContainer' data-chart-type='multi' data-label='Data Reduction Ratio and Compression Ratio' id='dataReductionCompressionRatio$srp_name$group_name'>" . json_encode(array(
                    array('name' => 'Data Reduction Ratio', 'type' => 'line', 'dataPoints' => $totalDataReductionRatio),
                    array('name' => 'Compression Ratio', 'type' => 'line', 'dataPoints' => $compressionRatio)
                )) . "</div>";

                $returnString .= "</div>";
            }
        }

        return $returnString;
    }

}
?>