<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadTime extends Model
{
    use HasFactory;
    protected $table ="time_setting";
    protected $primaryKey ="id";
    protected $fillable = ['lead_time'];
}
