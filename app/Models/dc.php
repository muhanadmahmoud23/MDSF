<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dc extends Model
{
    use HasFactory;

    protected $fillable = [
        'DC_ID',
        'DC_Code',
        'Name',
        'sales_reg_id',
        'entry_date',
        'update_date',
        'DESC_DC',
        'action',
        'trans_flag',
        'branch_code',
    ];
}
