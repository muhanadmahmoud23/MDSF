<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesMan extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_id',
        'sales_code',
        'sales_code_char',
        'name',
        'address',
        'tel_num',
        'mobile',
        'martial',
        'occupation',
        'education',
        'birthdate',
        'join_date',
        'status',
        'entry_date',
        'update_date',
        'km',
        'prs',
        'census',
        'key_flag',
        'call_card',
        'action',
        'trans_flag',
        'active',
        'salestype',
        'insurance',
        'branch_code',
        'E_name',
        'dc',
    ];
}
