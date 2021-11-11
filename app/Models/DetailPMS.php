<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPMS extends Model
{
    use HasFactory;
    protected $table = 'detail_pms';
    protected $guarded = ['id'];
    public $timestamps = false;
}
