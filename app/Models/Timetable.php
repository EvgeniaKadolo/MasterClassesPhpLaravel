<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function time()
    {
        return $this->belongsTo(Time::class);
    }

    public function master_class()
    {
        return $this->belongsTo(Master_class::class);
    }
}
