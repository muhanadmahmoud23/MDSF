<?php

namespace App\Imports;

use App\Models\SalesTerr;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class SalesTerrImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new SalesTerr([
            'sales_terr_id' => $row['0'],
            'sales_ter_code' => $row['1'],
            'name' => $row['2'],
            'dc_id' => $row['3'],
            'prod_group_id' => $row['4'],
            'route_type_id' => $row['5'],
            'entry_date' => new Carbon($row['6']),
            'update_date' => new Carbon($row['7']),
            'food_ws_rt' => $row['8'],
            'action' => $row['9'],
            'trans_flag' => $row['10'],
            'seq' => $row['11'],
            'reg_id' => $row['12'],
            'sectors' => $row['13'],
            'sector_id' => $row['14'],
            'branch_code' => $row['15'],
            'allow_sell_comp' => $row['16'],
            'No_overlap_allow_sell_comp' => $row['17'],
            'stock_by_comp' => $row['18'],
            'div' => $row['19'],
            'warehouse_id' => $row['20'],
        ]);
    }
}
