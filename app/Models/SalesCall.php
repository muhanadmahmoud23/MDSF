<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\POS;

class SalesCall extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_call_id',
        'sales_ter_id',
        'jou_id',
        'pos_code',
        'route_id',
        'call_status_id',
        'reason_id',
        'start_time',
        'end_time',
        'payment_id',
        'total_invoice',
        'incentive_amount',
        'net_amount',
        'tax_amount',
        'branch_code',

    ];
 
}
