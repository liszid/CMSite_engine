<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\{
    Log
    ,Check
    ,Valid
};

class qStorageGroup 
{
    public static function Get(): array
    {
		return array(
			'Insert' => self::Insert()
			,'Select' => self::Select()
			,'Update' => self::Update()
			,'Delete' => self::Delete()
		);
	}
	
	private static function Insert()
	{
		return '';
	}
	
	private static function Select()
	{
        return array(
            'All' => '
				SELECT sg.sgroup_id, sg.sphys_id, sg.group_name,  si.sym_id, si.srp_name, sg.provisioned, sg.subscribed_capacity, sg.user_data, sg.user_data_percent, sg.total_effective_used, sg.total_physical_used, sg.total_physical_used_percent, sg.total_unreducible_used, sg.total_data_reduction_ratio, sg.effective_used, sg.effective_used_pct, sg.allocated_capacity, sg.allocated_capacity_pct, sg.physical_used, sg.used_capacity, sg.unreducible_used_cap, sg.data_reduction_ratio, sg.compression_ratio, sg.snap_effective_used, sg.snap_allocated_capacity, sg.snap_physical_used, sg.snap_used_capacity, sg.snap_unreducible_used_cap, sg.snapshot_resources_used_percent, sg.snap_data_reduction_ratio, sg.compression_snapshot_ratio, sg.insert_date
				FROM StorageGroup sg
				JOIN StoragePhys sp ON sg.sphys_id = sp.sphys_id
				JOIN StorageId si ON sp.storage_id = si.storage_id;'
			, 'byId' => '
                SELECT sg.*, sp.physical_capacity, sp.usable_capacity, sp.compression_state, sp.compression_ratio AS storagePhys_compression_ratio,
					   sp.data_reduction_ratio AS storagePhys_data_reduction_ratio, sp.srdf_dse_allocated, sp.snapshot_effective_capacity,
					   sp.snapshots_allocated, sp.total_subscribed_pct, si.sym_id, si.srp_name
				FROM StorageGroup sg
				JOIN StoragePhys sp ON sg.sphys_id = sp.sphys_id
				JOIN StorageId si ON sp.storage_id = si.storage_id
				WHERE sg.sgroup_id=:sgroup_id/**/;'
            , 'bySpId' => '
                SELECT sg.*, sp.physical_capacity, sp.usable_capacity, sp.compression_state, sp.compression_ratio AS storagePhys_compression_ratio,
					   sp.data_reduction_ratio AS storagePhys_data_reduction_ratio, sp.srdf_dse_allocated, sp.snapshot_effective_capacity,
					   sp.snapshots_allocated, sp.total_subscribed_pct, si.sym_id, si.srp_name
				FROM StorageGroup sg
				JOIN StoragePhys sp ON sg.sphys_id = sp.sphys_id
				JOIN StorageId si ON sp.storage_id = si.storage_id
				WHERE sp.sphys_id=:sphys_id/**/;'
        );
	}
	
	private static function Update()
	{
		return '';
	}
	
	private static function Delete()
	{
		return '';
	}

}
?>