<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $table = 'component';

    protected $fillable = [
        'name', 'code', 'specification','maker' ,'part_number' ,'serial_number' ,'unit_id', 'images'
    ];

    protected $primaryKey = 'id';

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function part()
    {
        return $this->hasMany(Part::class, 'component_id');
    }
    // public function inventory()
    // {
    //     return $this->belongsTo(Inventory::class,'code' ,'item_code');
    // }
}
