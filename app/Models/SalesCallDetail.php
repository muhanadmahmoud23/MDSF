<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesCallDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'salescall_id',
        'salescall_details_id',
        'category_id',
        'payment_id',
        'total_invoice',
        'incentive_amount',
        'net_amout',
        'tax_amount',
        'phone',
        'name',
        'address',
        'email',
        'oursource_order',
    ];


}
