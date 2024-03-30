<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'card_no',
        'card_fee',
        'card_name',
    ];
}
