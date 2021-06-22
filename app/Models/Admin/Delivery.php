<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'resi_by_system',
        'container_name',
        'client_name',
        'origin_name',
        'destination_name',
        'delivery_type',
        'delivery_status',
    ];
}
