<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteType extends Model
{
    use HasFactory;

    protected $fillable = [
        'route_type_id',
        'route_type_code',
        'name',
        'UOM_Unit',
        'channel_id',
        'entry_date',
        'update_date',
        'action',
        'trans_flag',
        'UOM_id',
    ];
}
