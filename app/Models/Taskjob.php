<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taskjob extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function group()
    {
        return $this->hasOne(Group::class, 'kode', 'kode');
    }

    public function log_taskjob()
    {
        return $this->hasMany(LogTaskJob::class, 'id_taskjob', 'id');
    }

    public function detail()
    {
        return $this->hasOne(DetailPMS::class, 'id_taskjob', 'id');
    }
}
