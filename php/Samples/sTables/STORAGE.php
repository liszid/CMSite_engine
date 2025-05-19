<?php

declare(strict_types=1);

namespace Samples\sTables;

interface STORAGE
{
    const STORAGE = [
        "tableId" => "tableCapMngmtStorage",
        "tableRoot" => "Storage",
        "data" => [
            "storage_id" => ["text" => "Azonosító", "tooltip" => "", "never" => "true"],
            "sym_id" => ["text" => "Symmetrix azonosító", "tooltip" => ""],
            "srp_name" => ["text" => "SRP név", "tooltip" => ""],
            "insert_date" => ["text" => "Beillesztés dátuma", "tooltip" => ""],
        ],
        "button" => [
            ["color" => "warning", "fa" => "th-list", "action" => "View", "tooltip" => "Megtekintés", "level" => 1],
        ],
    ];
    const STORAGEPHYS = [
        "tableId" => "tableCapMngmtStoragePhys",
        "tableRoot" => "StoragePhys",
        "data" => [
            "sphys_id" => ["text" => "Azonosító", "tooltip" => "", "never" => "true"],
            "storage_id" => ["text" => "Storage ID", "tooltip" => ""],
            "physical_capacity" => ["text" => "Fizikai kapacitás", "tooltip" => ""],
            "usable_capacity" => ["text" => "Használható kapacitás", "tooltip" => ""],
            "compression_state" => ["text" => "Tömörítési állapot", "tooltip" => ""],
            "compression_ratio" => ["text" => "Tömörítési arány", "tooltip" => ""],
            "data_reduction_ratio" => ["text" => "Adatcsökkentési arány", "tooltip" => ""],
            "srdf_dse_allocated" => ["text" => "SRDF DSE allokált kapacitás", "tooltip" => ""],
            "snapshot_effective_capacity" => ["text" => "Snapshot hatékony kapacitás", "tooltip" => ""],
            "snapshots_allocated" => ["text" => "Snapshots allokált kapacitás", "tooltip" => ""],
            "total_subscribed_pct" => ["text" => "Teljes előfizetett kapacitás százalékban", "tooltip" => ""],
            "insert_date" => ["text" => "Beillesztés dátuma", "tooltip" => ""],
        ],
        "button" => [
            ["color" => "warning", "fa" => "th-list", "action" => "View", "tooltip" => "Megtekintés", "level" => 1],
        ],
    ];
    const STORAGETOTAL = [
        "tableId" => "tableCapMngmtStorageTotal",
        "tableRoot" => "StorageTotal",
        "data" => [
            "stotal_id" => ["text" => "Azonosító", "tooltip" => "", "never" => "true"],
            "sphys_id" => ["text" => "Storage Phys ID", "tooltip" => ""],
            "provisioned_capacity" => ["text" => "Provisioned kapacitás", "tooltip" => ""],
            "subscribed_capacity" => ["text" => "Előfizetett kapacitás", "tooltip" => ""],
            "effective_used" => ["text" => "Effektív használatban lévő kapacitás", "tooltip" => ""],
            "effective_used_pct" => ["text" => "Effektív használat százalékban", "tooltip" => ""],
            "allocated_capacity" => ["text" => "Allokált kapacitás", "tooltip" => ""],
            "allocated_capacity_pct" => ["text" => "Allokált kapacitás százalékban", "tooltip" => ""],
            "physical_used" => ["text" => "Fizikailag használatban lévő kapacitás", "tooltip" => ""],
            "used_capacity" => ["text" => "Használatban lévő kapacitás", "tooltip" => ""],
            "unreducible_used_cap" => ["text" => "Nem csökkenthető használt kapacitás", "tooltip" => ""],
            "compression_ratio" => ["text" => "Tömörítési arány", "tooltip" => ""],
            "snap_effective_used" => ["text" => "Snapshot effektív használatban lévő kapacitás", "tooltip" => ""],
            "snap_capacity" => ["text" => "Snapshot kapacitás", "tooltip" => ""],
            "snap_physical_used" => ["text" => "Snapshot fizikailag használatban lévő kapacitás", "tooltip" => ""],
            "snap_used_capacity" => ["text" => "Snapshot használatban lévő kapacitás", "tooltip" => ""],
            "snap_unreducible_used_cap" => ["text" => "Snapshot nem csökkenthető használt kapacitás", "tooltip" => ""],
            "compression_snapshot_ratio" => ["text" => "Snapshot tömörítési arány", "tooltip" => ""],
            "insert_date" => ["text" => "Beillesztés dátuma", "tooltip" => ""],
        ],
        "button" => [
            ["color" => "warning", "fa" => "th-list", "action" => "View", "tooltip" => "Megtekintés", "level" => 1],
        ],
    ];
    const STORAGEGROUP = [
        "tableId" => "tableCapMngmtStorageGroup",
        "tableRoot" => "StorageGroup",
        "data" => [
            "sgroup_id" => ["text" => "Azonosító", "tooltip" => "", "never" => "true"],
            "sphys_id" => ["text" => "Storage Phys ID", "tooltip" => ""],
            "group_name" => ["text" => "Csoport név", "tooltip" => ""],
            "provisioned" => ["text" => "Provisioned", "tooltip" => ""],
            "subscribed_capacity" => ["text" => "Előfizetett kapacitás", "tooltip" => ""],
            "user_data" => ["text" => "Felhasználói adatok", "tooltip" => ""],
            "user_data_percent" => ["text" => "Felhasználói adatok százaléka", "tooltip" => ""],
            "total_effective_used" => ["text" => "Teljes effektív használatban lévő kapacitás", "tooltip" => ""],
            "total_physical_used" => ["text" => "Teljes fizikailag használatban lévő kapacitás", "tooltip" => ""],
            "total_physical_used_percent" => [
                "text" => "Teljes fizikailag használatban lévő kapacitás százaléka",
                "tooltip" => "",
            ],
            "total_unreducible_used" => ["text" => "Teljes nem csökkenthető használt kapacitás", "tooltip" => ""],
            "total_data_reduction_ratio" => ["text" => "Teljes adatcsökkentési arány", "tooltip" => ""],
            "effective_used" => ["text" => "Effektív használatban lévő kapacitás", "tooltip" => ""],
            "effective_used_pct" => ["text" => "Effektív használat százalékban", "tooltip" => ""],
            "allocated_capacity" => ["text" => "Allokált kapacitás", "tooltip" => ""],
            "allocated_capacity_pct" => ["text" => "Allokált kapacitás százalékban", "tooltip" => ""],
            "physical_used" => ["text" => "Fizikailag használatban lévő kapacitás", "tooltip" => ""],
            "used_capacity" => ["text" => "Használatban lévő kapacitás", "tooltip" => ""],
            "unreducible_used_cap" => ["text" => "Nem csökkenthető használt kapacitás", "tooltip" => ""],
            "data_reduction_ratio" => ["text" => "Adatcsökkentési arány", "tooltip" => ""],
            "compression_ratio" => ["text" => "Tömörítési arány", "tooltip" => ""],
            "snap_effective_used" => ["text" => "Snapshot effektív használatban lévő kapacitás", "tooltip" => ""],
            "snap_allocated_capacity" => ["text" => "Snapshot allokált kapacitás", "tooltip" => ""],
            "snap_physical_used" => ["text" => "Snapshot fizikailag használatban lévő kapacitás", "tooltip" => ""],
            "snap_used_capacity" => ["text" => "Snapshot használatban lévő kapacitás", "tooltip" => ""],
            "snap_unreducible_used_cap" => ["text" => "Snapshot nem csökkenthető használt kapacitás", "tooltip" => ""],
            "snapshot_resources_used_percent" => [
                "text" => "Snapshot források használatának százaléka",
                "tooltip" => "",
            ],
            "snap_data_reduction_ratio" => ["text" => "Snapshot adatcsökkentési arány", "tooltip" => ""],
            "compression_snapshot_ratio" => ["text" => "Snapshot tömörítési arány", "tooltip" => ""],
            "insertdate" => ["text" => "Beillesztés dátuma", "tooltip" => ""],
        ],
        "button" => [
            ["color" => "warning", "fa" => "th-list", "action" => "View", "tooltip" => "Megtekintés", "level" => 1],
        ],
    ];
}
?>
