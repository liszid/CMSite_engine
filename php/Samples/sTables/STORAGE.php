<?php

declare(strict_types=1);

namespace Samples\sTables;

interface STORAGE
{
    const STORAGE = array(
        "tableId" => "tableCapMngmtStorage",
        "tableRoot" => "Storage",
        "data" => array(
            "storage_id" => array("text" => "Azonosító", "tooltip" => ""),
            "sym_id" => array("text" => "Symmetrix azonosító", "tooltip" => ""),
            "srp_name" => array("text" => "SRP név", "tooltip" => ""),
            "insert_date" => array("text" => "Beillesztés dátuma", "tooltip" => "")
        ),
        "button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
        )
    );
    const STORAGEPHYS = array(
        "tableId" => "tableCapMngmtStoragePhys",
        "tableRoot" => "StoragePhys",
        "data" => array(
            "sphys_id" => array("text" => "Azonosító", "tooltip" => ""),
            "storage_id" => array("text" => "Storage ID", "tooltip" => ""),
            "physical_capacity" => array("text" => "Fizikai kapacitás", "tooltip" => ""),
            "usable_capacity" => array("text" => "Használható kapacitás", "tooltip" => ""),
            "compression_state" => array("text" => "Tömörítési állapot", "tooltip" => ""),
            "compression_ratio" => array("text" => "Tömörítési arány", "tooltip" => ""),
            "data_reduction_ratio" => array("text" => "Adatcsökkentési arány", "tooltip" => ""),
            "srdf_dse_allocated" => array("text" => "SRDF DSE allokált kapacitás", "tooltip" => ""),
            "snapshot_effective_capacity" => array("text" => "Snapshot hatékony kapacitás", "tooltip" => ""),
            "snapshots_allocated" => array("text" => "Snapshots allokált kapacitás", "tooltip" => ""),
            "total_subscribed_pct" => array("text" => "Teljes előfizetett kapacitás százalékban", "tooltip" => ""),
            "insert_date" => array("text" => "Beillesztés dátuma", "tooltip" => "")
        ),
        "button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
        )
    );
    const STORAGETOTAL = array(
        "tableId" => "tableCapMngmtStorageTotal",
        "tableRoot" => "StorageTotal",
        "data" => array(
            "stotal_id" => array("text" => "Azonosító", "tooltip" => ""),
            "sphys_id" => array("text" => "Storage Phys ID", "tooltip" => ""),
            "provisioned_capacity" => array("text" => "Provisioned kapacitás", "tooltip" => ""),
            "subscribed_capacity" => array("text" => "Előfizetett kapacitás", "tooltip" => ""),
            "effective_used" => array("text" => "Effektív használatban lévő kapacitás", "tooltip" => ""),
            "effective_used_pct" => array("text" => "Effektív használat százalékban", "tooltip" => ""),
            "allocated_capacity" => array("text" => "Allokált kapacitás", "tooltip" => ""),
            "allocated_capacity_pct" => array("text" => "Allokált kapacitás százalékban", "tooltip" => ""),
            "physical_used" => array("text" => "Fizikailag használatban lévő kapacitás", "tooltip" => ""),
            "used_capacity" => array("text" => "Használatban lévő kapacitás", "tooltip" => ""),
            "unreducible_used_cap" => array("text" => "Nem csökkenthető használt kapacitás", "tooltip" => ""),
            "compression_ratio" => array("text" => "Tömörítési arány", "tooltip" => ""),
            "snap_effective_used" => array("text" => "Snapshot effektív használatban lévő kapacitás", "tooltip" => ""),
            "snap_capacity" => array("text" => "Snapshot kapacitás", "tooltip" => ""),
            "snap_physical_used" => array("text" => "Snapshot fizikailag használatban lévő kapacitás", "tooltip" => ""),
            "snap_used_capacity" => array("text" => "Snapshot használatban lévő kapacitás", "tooltip" => ""),
            "snap_unreducible_used_cap" => array("text" => "Snapshot nem csökkenthető használt kapacitás", "tooltip" => ""),
            "compression_snapshot_ratio" => array("text" => "Snapshot tömörítési arány", "tooltip" => ""),
            "insert_date" => array("text" => "Beillesztés dátuma", "tooltip" => "")
        ),
        "button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
        )
    );
    const STORAGEGROUP = array(
        "tableId" => "tableCapMngmtStorageGroup",
        "tableRoot" => "StorageGroup",
        "data" => array(
            "sgroup_id" => array("text" => "Azonosító", "tooltip" => ""),
            "sphys_id" => array("text" => "Storage Phys ID", "tooltip" => ""),
            "group_name" => array("text" => "Csoport név", "tooltip" => ""),
            "provisioned" => array("text" => "Provisioned", "tooltip" => ""),
            "subscribed_capacity" => array("text" => "Előfizetett kapacitás", "tooltip" => ""),
            "user_data" => array("text" => "Felhasználói adatok", "tooltip" => ""),
            "user_data_percent" => array("text" => "Felhasználói adatok százaléka", "tooltip" => ""),
            "total_effective_used" => array("text" => "Teljes effektív használatban lévő kapacitás", "tooltip" => ""),
            "total_physical_used" => array("text" => "Teljes fizikailag használatban lévő kapacitás", "tooltip" => ""),
            "total_physical_used_percent" => array("text" => "Teljes fizikailag használatban lévő kapacitás százaléka", "tooltip" => ""),
            "total_unreducible_used" => array("text" => "Teljes nem csökkenthető használt kapacitás", "tooltip" => ""),
            "total_data_reduction_ratio" => array("text" => "Teljes adatcsökkentési arány", "tooltip" => ""),
            "effective_used" => array("text" => "Effektív használatban lévő kapacitás", "tooltip" => ""),
            "effective_used_pct" => array("text" => "Effektív használat százalékban", "tooltip" => ""),
            "allocated_capacity" => array("text" => "Allokált kapacitás", "tooltip" => ""),
            "allocated_capacity_pct" => array("text" => "Allokált kapacitás százalékban", "tooltip" => ""),
            "physical_used" => array("text" => "Fizikailag használatban lévő kapacitás", "tooltip" => ""),
            "used_capacity" => array("text" => "Használatban lévő kapacitás", "tooltip" => ""),
            "unreducible_used_cap" => array("text" => "Nem csökkenthető használt kapacitás", "tooltip" => ""),
            "data_reduction_ratio" => array("text" => "Adatcsökkentési arány", "tooltip" => ""),
            "compression_ratio" => array("text" => "Tömörítési arány", "tooltip" => ""),
            "snap_effective_used" => array("text" => "Snapshot effektív használatban lévő kapacitás", "tooltip" => ""),
            "snap_allocated_capacity" => array("text" => "Snapshot allokált kapacitás", "tooltip" => ""),
            "snap_physical_used" => array("text" => "Snapshot fizikailag használatban lévő kapacitás", "tooltip" => ""),
            "snap_used_capacity" => array("text" => "Snapshot használatban lévő kapacitás", "tooltip" => ""),
            "snap_unreducible_used_cap" => array("text" => "Snapshot nem csökkenthető használt kapacitás", "tooltip" => ""),
            "snapshot_resources_used_percent" => array("text" => "Snapshot források használatának százaléka", "tooltip" => ""),
            "snap_data_reduction_ratio" => array("text" => "Snapshot adatcsökkentési arány", "tooltip" => ""),
            "compression_snapshot_ratio" => array("text" => "Snapshot tömörítési arány", "tooltip" => ""),
            "insertdate" => array("text" => "Beillesztés dátuma", "tooltip" => "")
        ),
        "button" => array(
            array('color' => 'warning', 'fa' => 'th-list', 'action' => 'View', 'tooltip' => 'Megtekintés', 'level' => 1)
        )
    );

}
?>