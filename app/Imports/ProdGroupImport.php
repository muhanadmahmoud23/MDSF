<?php

namespace App\Imports;

use App\Models\ProdGroup;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class ProdGroupImport implements ToModel
{
    public function model(array $row)
    {
        return new ProdGroup([
            'prod_group_id' => $row[0],
            'name' => $row[1],
            'entry_date' => new Carbon($row[2]),
            'update_date' => new Carbon($row[3]),
            'action' => $row[4],
            'trans_flag' => $row[5],
            'company_flag' => $row[6],
            'branch_code' => $row[7],
            'activity_flag' => $row[8],
        ]);
    }
}
