<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'installed', 'used', 'reserved', 'ready' ,'note' ,'item_code' ,'inventory_group_id'
    ];

    protected $primaryKey = 'id';

    public function part()
    {
        return $this->hasOne(Part::class,'code' ,'item_code');
    }
    // public function component()
    // {
    //     return $this->hasOne(Component::class,'code' ,'item_code');
    // }
    // public function unit()
    // {
    //     return $this->hasOne(Unit::class,'code' ,'item_code');
    // }

    public function inventory_group()
    {
        return $this->belongsTo(InventoryGroup::class, 'inventory_group_id');
    }
}
