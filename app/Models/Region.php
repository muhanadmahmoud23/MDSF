<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg_id',
        'reg_code',
        'name',
        'name_e',
        'entry_date',
        'update_date',
        'reg_census_code',
        'reg_name',
        'action',
        'trans_flag',
        'branch_code',
    ];
}
