<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freq extends Model
{
    use HasFactory;

    protected $table = 'freq';
    protected $guarded = ['id'];
    public $timestamps = false;
}
