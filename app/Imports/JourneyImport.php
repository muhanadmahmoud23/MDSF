<?php

namespace App\Imports;

use App\Models\Journey;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class JourneyImport implements ToModel
{

    public function model(array $row)
    {
        return new Journey([
            'sales_ter_id' => $row[0],
            'jou_id' => $row[1],
            'route_id' => $row[2],
            'sales_rep_id' => $row[3],
            'start_date' => new Carbon($row[4]),
            'end_date' => new Carbon($row[5]),
            'van_id' => $row[6],
            'beg_km' => $row[7],
            'end_km' => $row[8],
            'jou_seq' => $row[9],
            'branch_code' => $row[10],
        ]);
    }
}
