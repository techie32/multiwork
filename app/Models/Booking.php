<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table ="Booking";
    protected $fillable = ['zip_code','service_type','model','device_issue_name','device_issue_description','screen_color','warrenty','screen_protector','charger_cable','date','time','address','unit_floor','name','phone','email','total_price'];
}
