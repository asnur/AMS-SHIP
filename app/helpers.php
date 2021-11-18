<?php

use App\Models\Group;
use App\Models\InventoryStock;
use Illuminate\Support\Facades\DB;

function name_taskjob(int $id)
{
    return Group::where('kode', $id)->first();
}

function stock($id_item, $type)
{
    $data = DB::table('inventory_stock')->select('id', 'id_item', "$type")->where('id_item', $id_item)->sum($type);

    return $data;
}
