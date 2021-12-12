<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubGroup extends Model
{
    use HasFactory;

    protected $table = 'sub_group';

    protected $fillable = [
        'name', 'code', 'specification', 'group_id'
    ];

    protected $primaryKey = 'id';

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }
    public function task_job()
    {
        return $this->belongsTo(Taskjob::class, 'code');
    }
    public function unit()
    {
        return $this->hasMany(Unit::class, 'sub_group_id');
    }
}
