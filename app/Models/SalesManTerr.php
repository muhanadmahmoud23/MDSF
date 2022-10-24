<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesManTerr extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_ter_id',
        'sales_code',
        'sales_id',
        'route_type_id',
        'name',
        'position',
        'address',
        'tel_num',
        'mobile',
        'martial',
        'occupation',
        'education',
        'birthdate',
        'join_date',
        'van_id',
        'status',
        'manager_id',
        'sales_code_char',
        'from_date',
        'to_date',
        'entry_date',
        'updated_date',
        'active',
        'handover_date',
        'handover_posting_date',
        'action',
        'trans_flag',
        'branch_code',
    ];
}
