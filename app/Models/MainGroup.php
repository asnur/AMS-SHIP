<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainGroup extends Model
{
    use HasFactory;

    protected $table = 'main_group';

    protected $fillable = [
        'name', 'code', 'specification',
    ];

    protected $primaryKey = 'id';

    public function group()
    {
        return $this->hasMany(Group::class, 'main_group_id');
    }
}
