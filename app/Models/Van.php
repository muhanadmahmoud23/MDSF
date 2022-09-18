<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van extends Model
{
    use HasFactory;

    protected $fillable = [
        'van_id',
        'van_code',
        'model',
        'manu_year',
        'car_num',
        'license',
        'eng_num',
        'bod_num',
        'entry_date',
        'updated_date',
        'temp',
        'FMS',
        'active',
        'fms_flag',
        'company',
        'action',
        'trans_flag',
        'cases_count',
        'branch_code',
        'eng_num_back',
        'bod_num_back',
        'regisration_date',
        'ending_km',
        'counter_change_date',
    ];
}
