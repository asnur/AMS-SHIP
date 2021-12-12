<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryGroup extends Model
{
    use HasFactory;
    protected $table = 'inventory_group';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'inventory_group_id');
    }
}
