<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $table = 'part';

    protected $fillable = [
        'name', 'code', 'specification','maker' ,'part_number' ,'serial_number' ,'component_id', 'images'
    ];

    protected $primaryKey = 'id';

    public function component()
    {
        return $this->belongsTo(Component::class, 'component_id');
    }
    public function inventory()
    {
        return $this->belongsTo(Inventory::class,'code' ,'item_code');
    }
}
