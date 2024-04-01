<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_category_id',
        'vehicle_card_id',
        'vehicle_name',
        'card_fee',
        'reg_no',
        'owner_name',
        'owner_contact'
    ];
}
