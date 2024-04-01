<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleProcess extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_card_id',
        'vehicle_id',
        'time_in',
        'time_out',
        'fee_charge',
        'status'
    ];
}
