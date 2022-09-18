<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'prod_group_id',
        'name',
        'entry_date',
        'update_date',
        'action',
        'trans_flag',
        'company_flag',
        'branch_code',
        'activity_flag',
    ];
}
