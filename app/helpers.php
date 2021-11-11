<?php

use App\Models\Group;
use App\Models\InventoryStock;
use Illuminate\Support\Facades\DB;

function name_taskjob(int $id)
{
    return Group::where('kode', $id)->first();
}

function stock($id_group, $type)
{
    $data = DB::table('inventory_stock')->select('id', 'id_group', "$type")->where('id_group', $id_group)->sum($type);

    return $data;
}
