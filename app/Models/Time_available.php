<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time_available extends Model
{
    use HasFactory;
    protected $table ="time_available";
    protected $primaryKey ="id";
    protected $fillable = ['day_name','start_time','end_time'];
    // protected $dates = ['start_time','end_time'];
    protected $casts = [
        // 'day_name' => 'array',
        // 'start_time' => 'array',
        // 'end_time' => 'array',
        // 'start_time' => 'datetime: H:i',
        // 'end_time' => 'datetime: H:i',  
    ];

    public function setNameAttribute($value)
    {
        // $this->attributes['start_time'] = date('H:i', strtotime($value));S
    }
}

