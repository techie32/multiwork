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

}

