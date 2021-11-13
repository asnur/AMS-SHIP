<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    use HasFactory;
    protected $table = 'inventory_stock';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function group()
    {
        return $this->hasOne(Group::class, 'kode', 'id_item');
    }
}
