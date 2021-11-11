<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTaskJob extends Model
{
    use HasFactory;

    protected $table = 'log_taskjobs';
    protected $guarded = ['id'];
    public $timestamps = false;
}
