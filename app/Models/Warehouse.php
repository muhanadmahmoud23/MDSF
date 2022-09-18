<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'warehouse_id',
        'warehouse_name',
        'def_warehouse',
        'warehouse_code',
        'warehouse_desc',
        'warehouse_address',
        'zip_code',
        'warehouse_city',
        'dc_id_sfis',
        'branch_code',
        'to_sla_LNK',
        'sales_office',
    ];
}
