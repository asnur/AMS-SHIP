<?php

use App\Models\SubGroup;
use App\Models\InventoryStock;
use Illuminate\Support\Facades\DB;

function name_taskjob(int $code)
{
    return SubGroup::select('name')->where('code', $code)->first();
}

function stock($id_item, $type)
{
    $data = DB::table('inventory')->select('id', 'item_code', "$type")->where('item_code', $id_item)->sum($type);

    return $data;
}
