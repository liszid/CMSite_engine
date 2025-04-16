<?php

declare(strict_types=1);

namespace Page\Classes;

use Toolkit\{Log, Check, Valid};
use Data\{dStorageId, dStoragePhys, dStorageTotal, dStorageGroup};
use Samples\{sCard, sTables, sTranslate, sForm, sFrame};

class sCapacity
{
    protected static $dStorageId;
    protected static $dStoragePhys;
    protected static $dStorageTotal;
    protected static $dStorageGroup;

    const RETURN_PATH = ["Storage" => ["x" => "Capacity", "y" => "Storage"]];

    protected static function setDStorageId()
    {
        self::$dStorageId = new dStorageId();
    }
    protected static function setDStoragePhys()
    {
        self::$dStoragePhys = new dStoragePhys();
    }
    protected static function setDStorageTotal()
    {
        self::$dStorageTotal = new dStorageTotal();
    }
    protected static function setDStorageGroup()
    {
        self::$dStorageGroup = new dStorageGroup();
    }

    public static function Action(array $array): string
    {
        $array["defaultData"] = self::FORMDATA[$array["y"]];
        $array["origo"] = self::TYPES[$array["y"]]["origo"] . $array["z"];
        $array["returnPath"] = self::RETURN_PATH[$array["y"]];
        $returnContent = self::{$array["z"]}($array);

        if (Valid::vString($returnContent)) {
            $returnContent = '<div class="text-center justification-centered">' . $returnContent . "</div>";
        }

        return $returnContent;
    }

    //Nincs használatban
    public static function Page(array $array): string
    {
        $returnString = "";

        if (isset($array["path"])) {
            $returnString .= sCard::Collapsible(sTranslate::Info($array["path"]));
        }
        $returnString .= "PAGE";
        return $returnString;
    }

    public static function StoragePage(array $array): string
    {
        self::setDStorageTotal();
        $returnString = "";
        $fClass = self::$dStorageTotal->Select(["userId" => $GLOBALS["sessionId"]], "All");
        $storageData = [];
        foreach ($fClass as $data) {
            $storage_id = $data["storage_id"];
            if (!isset($storageData[$storage_id])) {
                $storageData[$storage_id] = [];
            }
            $storageData[$storage_id][] = $data;
        }
        $jsonStorageData = json_encode($storageData);
        $returnString .= "<script>let storageData = $jsonStorageData;</script>";
        foreach ($storageData as $storage_id => $records) {
            $sym_id = $records[0]["sym_id"];
            $srp_name = $records[0]["srp_name"];

            $physicalCapacityData = [];
            $usableCapacityData = [];
            $snapshotEffectiveCapacityData = [];
            $srdfDseAllocatedData = [];
            $snapshotsAllocatedData = [];
            $compressionRatioData = [];
            $dataReductionRatioData = [];
            $totalSubscribedPctData = [];
            $provisionedCapacityData = [];
            $subscribedCapacityData = [];
            $effectiveUsedData = [];
            $effectiveUsedPctData = [];
            $allocatedCapacityData = [];
            $allocatedCapacityPctData = [];
            $physicalUsedData = [];
            $usedCapacityData = [];
            $unreducibleUsedCapData = [];
            $snapEffectiveUsedData = [];
            $snapCapacityData = [];
            $snapPhysicalUsedData = [];
            $snapUsedCapacityData = [];
            $snapUnreducibleUsedCapData = [];
            $compressionSnapshotRatioData = [];

            foreach ($records as $record) {
                $timestamp = strtotime($record["insert_date"]);
                $physicalCapacityData[] = ["x" => $timestamp, "y" => $record["physical_capacity"]];
                $usableCapacityData[] = ["x" => $timestamp, "y" => $record["usable_capacity"]];
                $snapshotEffectiveCapacityData[] = ["x" => $timestamp, "y" => $record["snapshot_effective_capacity"]];
                $srdfDseAllocatedData[] = ["x" => $timestamp, "y" => $record["srdf_dse_allocated"]];
                $snapshotsAllocatedData[] = ["x" => $timestamp, "y" => $record["snapshots_allocated"]];
                $compressionRatioData[] = ["x" => $timestamp, "y" => floatval($record["compression_ratio"])];
                $dataReductionRatioData[] = [
                    "x" => $timestamp,
                    "y" => floatval($record["storagePhys_data_reduction_ratio"]),
                ];
                $totalSubscribedPctData[] = ["x" => $timestamp, "y" => floatval($record["total_subscribed_pct"])];
                $provisionedCapacityData[] = ["x" => $timestamp, "y" => $record["provisioned_capacity"]];
                $subscribedCapacityData[] = ["x" => $timestamp, "y" => $record["subscribed_capacity"]];
                $effectiveUsedData[] = ["x" => $timestamp, "y" => $record["effective_used"]];
                $effectiveUsedPctData[] = ["x" => $timestamp, "y" => $record["effective_used_pct"]];
                $allocatedCapacityData[] = ["x" => $timestamp, "y" => $record["allocated_capacity"]];
                $allocatedCapacityPctData[] = ["x" => $timestamp, "y" => $record["allocated_capacity_pct"]];
                $physicalUsedData[] = ["x" => $timestamp, "y" => $record["physical_used"]];
                $usedCapacityData[] = ["x" => $timestamp, "y" => $record["used_capacity"]];
                $unreducibleUsedCapData[] = ["x" => $timestamp, "y" => $record["unreducible_used_cap"]];
                $snapEffectiveUsedData[] = ["x" => $timestamp, "y" => $record["snap_effective_used"]];
                $snapCapacityData[] = ["x" => $timestamp, "y" => $record["snap_capacity"]];
                $snapPhysicalUsedData[] = ["x" => $timestamp, "y" => $record["snap_physical_used"]];
                $snapUsedCapacityData[] = ["x" => $timestamp, "y" => $record["snap_used_capacity"]];
                $snapUnreducibleUsedCapData[] = ["x" => $timestamp, "y" => $record["snap_unreducible_used_cap"]];
                $compressionSnapshotRatioData[] = [
                    "x" => $timestamp,
                    "y" => floatval($record["compression_snapshot_ratio"]),
                ];
            }

            $returnString .= "<button class='collapsible specheader'><h3>$sym_id - $srp_name</h3></button>";
            $returnString .= "<div class='chart-container-wrapper collapsible-content'>";

            // 1. diagramm: Physical and Usable Capacity
            $returnString .=
                "<div class='chartContainer' data-chart-type='multi' data-label='Physical and Usable Capacity' id='physicalUsableCapacity$storage_id'>" .
                json_encode([
                    ["name" => "Physical Capacity", "type" => "line", "dataPoints" => $physicalCapacityData],
                    ["name" => "Usable Capacity", "type" => "line", "dataPoints" => $usableCapacityData],
                ]) .
                "</div>";

            // 2. diagramm: Snapshot Effective Capacity, SRDF DSE Allocated, Snapshots Allocated
            $returnString .=
                "<div class='chartContainer' data-chart-type='multi' data-label='Snapshot Effective Capacity, SRDF DSE Allocated, Snapshots Allocated' id='snapshotEffectiveCapacity$storage_id'>" .
                json_encode([
                    [
                        "name" => "Snapshot Effective Capacity",
                        "type" => "line",
                        "dataPoints" => $snapshotEffectiveCapacityData,
                    ],
                    ["name" => "SRDF DSE Allocated", "type" => "area", "dataPoints" => $srdfDseAllocatedData],
                    ["name" => "Snapshots Allocated", "type" => "area", "dataPoints" => $snapshotsAllocatedData],
                ]) .
                "</div>";

            // 3. diagramm: Compression Ratio, Data Reduction Ratio, Total Subscribed Percentage
            $returnString .=
                "<div class='chartContainer' data-chart-type='multi' data-label='Compression Ratio, Data Reduction Ratio, Total Subscribed Percentage' id='compressionData$storage_id'>" .
                json_encode([
                    ["name" => "Compression Ratio", "type" => "column", "dataPoints" => $compressionRatioData],
                    ["name" => "Data Reduction Ratio", "type" => "column", "dataPoints" => $dataReductionRatioData],
                    [
                        "name" => "Total Subscribed Percentage",
                        "type" => "line",
                        "dataPoints" => $totalSubscribedPctData,
                    ],
                ]) .
                "</div>";

            // 4. diagramm: Provisioned and Subscribed Capacity
            $returnString .=
                "<div class='chartContainer' data-chart-type='multi' data-label='Provisioned and Subscribed Capacity' id='provisionedSubscribedCapacity$storage_id'>" .
                json_encode([
                    ["name" => "Provisioned Capacity", "type" => "line", "dataPoints" => $provisionedCapacityData],
                    ["name" => "Subscribed Capacity", "type" => "line", "dataPoints" => $subscribedCapacityData],
                ]) .
                "</div>";

            // 5. diagramm: Effective Used and Allocated Capacity
            $returnString .=
                "<div class='chartContainer' data-chart-type='multi' data-label='Effective Used and Allocated Capacity' id='effectiveAllocatedCapacity$storage_id'>" .
                json_encode([
                    ["name" => "Effective Used", "type" => "line", "dataPoints" => $effectiveUsedData],
                    ["name" => "Effective Used Percentage", "type" => "line", "dataPoints" => $effectiveUsedPctData],
                    ["name" => "Allocated Capacity", "type" => "line", "dataPoints" => $allocatedCapacityData],
                    [
                        "name" => "Allocated Capacity Percentage",
                        "type" => "line",
                        "dataPoints" => $allocatedCapacityPctData,
                    ],
                ]) .
                "</div>";

            // 6. diagramm: Physical Used and Used Capacity
            $returnString .=
                "<div class='chartContainer' data-chart-type='multi' data-label='Physical Used and Used Capacity' id='physicalUsedCapacity$storage_id'>" .
                json_encode([
                    ["name" => "Physical Used", "type" => "line", "dataPoints" => $physicalUsedData],
                    ["name" => "Used Capacity", "type" => "line", "dataPoints" => $usedCapacityData],
                ]) .
                "</div>";

            // 7. diagramm: Unreducible Used Capacity
            $returnString .=
                "<div class='chartContainer' data-chart-type='multi' data-label='Unreducible Used Capacity' id='unreducibleUsedCapacity$storage_id'>" .
                json_encode([
                    ["name" => "Unreducible Used Capacity", "type" => "line", "dataPoints" => $unreducibleUsedCapData],
                ]) .
                "</div>";

            // 8. diagramm: Snapshot Effective Used, Snapshot Capacity, Snapshot Physical Used, Snapshot Used Capacity, Snapshot Unreducible Used Cap
            $returnString .=
                "<div class='chartContainer' data-chart-type='multi' data-label='Snapshot Data' id='snapshotData$storage_id'>" .
                json_encode([
                    ["name" => "Snapshot Effective Used", "type" => "line", "dataPoints" => $snapEffectiveUsedData],
                    ["name" => "Snapshot Capacity", "type" => "line", "dataPoints" => $snapCapacityData],
                    ["name" => "Snapshot Physical Used", "type" => "line", "dataPoints" => $snapPhysicalUsedData],
                    ["name" => "Snapshot Used Capacity", "type" => "line", "dataPoints" => $snapUsedCapacityData],
                    [
                        "name" => "Snapshot Unreducible Used Capacity",
                        "type" => "line",
                        "dataPoints" => $snapUnreducibleUsedCapData,
                    ],
                ]) .
                "</div>";

            // 9. diagramm: Compression Snapshot Ratio
            $returnString .=
                "<div class='chartContainer' data-chart-type='multi' data-label='Compression Snapshot Ratio' id='compressionSnapshotRatio$storage_id'>" .
                json_encode([
                    [
                        "name" => "Compression Snapshot Ratio",
                        "type" => "line",
                        "dataPoints" => $compressionSnapshotRatioData,
                    ],
                ]) .
                "</div>";

            $returnString .= "</div>";
        }

        return $returnString;
    }

    public static function GroupPage(array $array): string
    {
        self::setDStorageGroup();
        $returnString = "";
        $fClass = self::$dStorageGroup->Select(["userId" => $GLOBALS["sessionId"]], "All");

        $storageData = [];
        foreach ($fClass as $data) {
            if (isset($data["srp_name"]) && isset($data["group_name"])) {
                $srp_name = $data["srp_name"];
                $group_name = $data["group_name"];
                if (!isset($storageData[$srp_name])) {
                    $storageData[$srp_name] = [];
                }
                if (!isset($storageData[$srp_name][$group_name])) {
                    $storageData[$srp_name][$group_name] = [];
                }
                $storageData[$srp_name][$group_name][] = $data;
            } else {
                error_log("Missing srp_name or group_name in data: " . print_r($data, true));
            }
        }

        $jsonStorageData = json_encode($storageData);
        $returnString .= "<script>let storageData = $jsonStorageData;</script>";

        // Diagramok létrehozása
        foreach ($storageData as $srp_name => $groups) {
            foreach ($groups as $group_name => $records) {
                $sym_id = $records[0]["sym_id"];
                $provisionedData = [];
                $subscribedCapacityData = [];
                $userData = [];
                $userDataPercent = [];
                $totalEffectiveUsed = [];
                $totalPhysicalUsed = [];
                $totalPhysicalUsedPercent = [];
                $totalUnreducibleUsed = [];
                $totalDataReductionRatio = [];
                $effectiveUsed = [];
                $effectiveUsedPct = [];
                $allocatedCapacity = [];
                $allocatedCapacityPct = [];
                $physicalUsed = [];
                $usedCapacity = [];
                $unreducibleUsedCap = [];
                $dataReductionRatio = [];
                $compressionRatio = [];

                foreach ($records as $record) {
                    $timestamp = strtotime($record["insert_date"]);
                    $provisionedData[] = ["x" => $timestamp, "y" => $record["provisioned"]];
                    $subscribedCapacityData[] = ["x" => $timestamp, "y" => $record["subscribed_capacity"]];
                    $userData[] = ["x" => $timestamp, "y" => $record["user_data"]];
                    $userDataPercent[] = ["x" => $timestamp, "y" => $record["user_data_percent"]];
                    $totalEffectiveUsed[] = ["x" => $timestamp, "y" => $record["total_effective_used"]];
                    $totalPhysicalUsed[] = ["x" => $timestamp, "y" => $record["total_physical_used"]];
                    $totalPhysicalUsedPercent[] = ["x" => $timestamp, "y" => $record["total_physical_used_percent"]];
                    $totalUnreducibleUsed[] = ["x" => $timestamp, "y" => $record["total_unreducible_used"]];
                    $totalDataReductionRatio[] = ["x" => $timestamp, "y" => $record["total_data_reduction_ratio"]];
                    $effectiveUsed[] = ["x" => $timestamp, "y" => $record["effective_used"]];
                    $effectiveUsedPct[] = ["x" => $timestamp, "y" => $record["effective_used_pct"]];
                    $allocatedCapacity[] = ["x" => $timestamp, "y" => $record["allocated_capacity"]];
                    $allocatedCapacityPct[] = ["x" => $timestamp, "y" => $record["allocated_capacity_pct"]];
                    $physicalUsed[] = ["x" => $timestamp, "y" => $record["physical_used"]];
                    $usedCapacity[] = ["x" => $timestamp, "y" => $record["used_capacity"]];
                    $unreducibleUsedCap[] = ["x" => $timestamp, "y" => $record["unreducible_used_cap"]];
                    $dataReductionRatio[] = ["x" => $timestamp, "y" => $record["data_reduction_ratio"]];
                    $compressionRatio[] = ["x" => $timestamp, "y" => $record["compression_ratio"]];
                }

                $returnString .= "<button class='collapsible specheader'><h3>$sym_id - $srp_name - $group_name</h3></button>";
                $returnString .= "<div class='chart-container-wrapper collapsible-content'>";

                // 1. diagram: Provisioned vs Subscribed Capacity
                $returnString .=
                    "<div class='chartContainer' data-chart-type='multi' data-label='Provisioned vs Subscribed Capacity' id='provisionedSubscribedCapacity$srp_name$group_name'>" .
                    json_encode([
                        ["name" => "Provisioned", "type" => "line", "dataPoints" => $provisionedData],
                        ["name" => "Subscribed Capacity", "type" => "line", "dataPoints" => $subscribedCapacityData],
                    ]) .
                    "</div>";

                // 2. diagram: User Data and User Data Percent
                $returnString .=
                    "<div class='chartContainer' data-chart-type='multi' data-label='User Data and User Data Percent' id='userData$srp_name$group_name'>" .
                    json_encode([
                        ["name" => "User Data", "type" => "line", "dataPoints" => $userData],
                        ["name" => "User Data Percent", "type" => "line", "dataPoints" => $userDataPercent],
                    ]) .
                    "</div>";

                // 3. diagram: Total Effective Used and Total Physical Used
                $returnString .=
                    "<div class='chartContainer' data-chart-type='multi' data-label='Total Effective Used and Total Physical Used' id='totalEffectivePhysicalUsed$srp_name$group_name'>" .
                    json_encode([
                        ["name" => "Total Effective Used", "type" => "line", "dataPoints" => $totalEffectiveUsed],
                        ["name" => "Total Physical Used", "type" => "line", "dataPoints" => $totalPhysicalUsed],
                    ]) .
                    "</div>";

                // 4. diagram: Total Physical Used Percent and Total Unreducible Used
                $returnString .=
                    "<div class='chartContainer' data-chart-type='multi' data-label='Total Physical Used Percent and Total Unreducible Used' id='totalPhysicalUsedPercent$srp_name$group_name'>" .
                    json_encode([
                        [
                            "name" => "Total Physical Used Percent",
                            "type" => "line",
                            "dataPoints" => $totalPhysicalUsedPercent,
                        ],
                        ["name" => "Total Unreducible Used", "type" => "line", "dataPoints" => $totalUnreducibleUsed],
                    ]) .
                    "</div>";

                // 5. diagram: Data Reduction Ratio and Compression Ratio
                $returnString .=
                    "<div class='chartContainer' data-chart-type='multi' data-label='Data Reduction Ratio and Compression Ratio' id='dataReductionCompressionRatio$srp_name$group_name'>" .
                    json_encode([
                        ["name" => "Data Reduction Ratio", "type" => "line", "dataPoints" => $totalDataReductionRatio],
                        ["name" => "Compression Ratio", "type" => "line", "dataPoints" => $compressionRatio],
                    ]) .
                    "</div>";

                $returnString .= "</div>";
            }
        }

        return $returnString;
    }
}
?>
