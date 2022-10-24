<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReg extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_reg_id',
        'sales_reg_code',
        'Name',
        'entry_date',
        'update_date',
        'aname',
        'action',
        'trans_flag',
        'branch_code',
    ];
}
