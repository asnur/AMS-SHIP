<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'group';

    protected $fillable = [
        'name', 'code', 'specification', 'main_group_id'
    ];

    protected $primaryKey = 'id';

    public function main_group()
    {
        return $this->belongsTo(MainGroup::class, 'main_group_id');
    }
    public function sub_group()
    {
        return $this->hasMany(SubGroup::class, 'group_id');
    }
}
