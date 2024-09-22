<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $table = "visitor";
    protected $primaryKey = "visitor_id";
    protected $fillable = [
        'visit_date',
        'ip_address', 
        'city', 
        'region', 
        'country', 
        'timezone', 
        'latitude', 
        'longitude',   
    ];
}
