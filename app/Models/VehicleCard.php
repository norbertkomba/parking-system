<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_token',
        'card_no',
        'card_name',
    ];
}
