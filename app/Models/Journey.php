<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_ter_id',
        'jou_id',
        'route_id',
        'sales_rep_id',
        'start_date',
        'end_date',
        'van_id',
        'beg_km',
        'end_km',
        'jou_seq',
        'branch_code',
    ];
}
