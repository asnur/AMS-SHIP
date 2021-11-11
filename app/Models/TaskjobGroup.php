<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class TaskjobGroup extends Model
{
    use HasFactory;

    protected $table = "taskjob_group";
    protected $guarded = ['id'];
    public $timestamps = false;

    public function count_taskjob()
    {
        if (Auth::user()->can('give permission taskjob')) {
            return $this->hasMany(Taskjob::class, 'group_id', 'id');
        } else {
            return $this->hasMany(Taskjob::class, 'group_id', 'id')->where('role', '=', Auth::user()->getRoleNames()->first());
        }
    }

    public function taskjob()
    {
        if (Auth::user()->can('give permission taskjob')) {
            return $this->hasMany(Taskjob::class, 'group_id', 'id');
        } else {
            return $this->hasMany(Taskjob::class, 'group_id', 'id')->where('role', Auth::user()->getNameRoles()->first());
        }
    }
}
