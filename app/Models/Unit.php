<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'unit';

    protected $fillable = [
        'name', 'code', 'specification','maker' ,'part_number' ,'serial_number' ,'sub_group_id', 'images'
    ];

    protected $primaryKey = 'id';

    public function sub_group()
    {
        return $this->belongsTo(SubGroup::class, 'sub_group_id');
    }
    public function component()
    {
        return $this->hasMany(Component::class, 'unit_id');
    }
    // public function inventory()
    // {
    //     return $this->belongsTo(Inventory::class,'code' ,'item_code');
    // }
}
