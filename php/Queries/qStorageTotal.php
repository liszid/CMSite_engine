<?php

declare(strict_types=1);

namespace Queries;

use Toolkit\{Log, Check, Valid};

class qStorageTotal
{
	public static function Get(): array
	{
		return [
			"Insert" => self::Insert(),
			"Select" => self::Select(),
			"Update" => self::Update(),
			"Delete" => self::Delete(),
		];
	}

	private static function Insert()
	{
		return "";
	}

	private static function Select()
	{
		return [
			"All" => '
				SELECT si.storage_id, sp.physical_capacity, sp.usable_capacity, sp.compression_state, sp.compression_ratio AS storagePhys_compression_ratio,
					   sp.data_reduction_ratio AS storagePhys_data_reduction_ratio, sp.srdf_dse_allocated, sp.snapshot_effective_capacity,
					   sp.snapshots_allocated, sp.total_subscribed_pct, si.sym_id, si.srp_name, st.provisioned_capacity, st.subscribed_capacity, 
					   st.effective_used, st.effective_used_pct, st.allocated_capacity, st.allocated_capacity_pct, st.physical_used, st.used_capacity, 
					   st.unreducible_used_cap, st.compression_ratio, st.snap_effective_used, st.snap_capacity, st.snap_physical_used, st.snap_used_capacity,
					   st.snap_unreducible_used_cap, st.compression_snapshot_ratio, sp.insert_date			
				FROM StorageTotal st
				JOIN StoragePhys sp ON st.sphys_id = sp.sphys_id
				JOIN StorageId si ON sp.storage_id = si.storage_id;',
			"byId" => '
                SELECT si.storage_id, sp.physical_capacity, sp.usable_capacity, sp.compression_state, sp.compression_ratio AS storagePhys_compression_ratio,
					   sp.data_reduction_ratio AS storagePhys_data_reduction_ratio, sp.srdf_dse_allocated, sp.snapshot_effective_capacity,
					   sp.snapshots_allocated, sp.total_subscribed_pct, si.sym_id, si.srp_name, st.provisioned_capacity, st.subscribed_capacity, 
					   st.effective_used, st.effective_used_pct, st.allocated_capacity, st.allocated_capacity_pct, st.physical_used, st.used_capacity, 
					   st.unreducible_used_cap, st.compression_ratio, st.snap_effective_used, st.snap_capacity, st.snap_physical_used, st.snap_used_capacity,
					   st.snap_unreducible_used_cap, st.compression_snapshot_ratio, sp.insert_date
				FROM StorageTotal st
				JOIN StoragePhys sp ON st.sphys_id = sp.sphys_id
				JOIN StorageId si ON sp.storage_id = si.storage_id;
                WHERE st.stotal_id=:stotal_id/**/;',
			"bySpId" => '
                SELECT si.storage_id, sp.physical_capacity, sp.usable_capacity, sp.compression_state, sp.compression_ratio AS storagePhys_compression_ratio,
					   sp.data_reduction_ratio AS storagePhys_data_reduction_ratio, sp.srdf_dse_allocated, sp.snapshot_effective_capacity,
					   sp.snapshots_allocated, sp.total_subscribed_pct, si.sym_id, si.srp_name, st.provisioned_capacity, st.subscribed_capacity, 
					   st.effective_used, st.effective_used_pct, st.allocated_capacity, st.allocated_capacity_pct, st.physical_used, st.used_capacity, 
					   st.unreducible_used_cap, st.compression_ratio, st.snap_effective_used, st.snap_capacity, st.snap_physical_used, st.snap_used_capacity,
					   st.snap_unreducible_used_cap, st.compression_snapshot_ratio, sp.insert_date
				FROM StorageTotal st
				JOIN StoragePhys sp ON st.sphys_id = sp.sphys_id
				JOIN StorageId si ON sp.storage_id = si.storage_id;
                WHERE sp.sphys_id=:sphys_id/**/;',
		];
	}

	private static function Update()
	{
		return "";
	}

	private static function Delete()
	{
		return "";
	}
}
?>
