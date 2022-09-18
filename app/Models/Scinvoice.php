<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scinvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'prod_id',
        'Uom_id',
        'Quantity',
        'Total_value',
        'incentive_value',
        'net_value',
        'loading_number',
        'salescall_details_id',
        'created_at',
        'updated_at',
    ];
}
