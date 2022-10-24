<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTerr extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_terr_id',
        'sales_ter_code',
        'name',
        'dc_id',
        'prod_group_id',
        'route_type_id',
        'entry_date',
        'update_date',
        'food_ws_rt',
        'action',
        'trans_flag',
        'seq',
        'reg_id',
        'sectors',
        'sector_id',
        'branch_code',
        'allow_sell_comp',
        'No_overlap_allow_sell_comp',
        'stock_by_comp',
        'div',
        'warehouse_id',
    ];
}
