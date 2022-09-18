<?php

namespace App\Imports;


use App\Models\Van;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class VanImport implements ToModel
{

    public function model(array $row)
    {
        return new Van([
            'van_id' => $row[0],
            'van_code' => $row[1],
            'model' => $row[2],
            'manu_year' => $row[3],
            'car_num' => $row[4],
            'license' => $row[5],
            'eng_num' => $row[6],
            'bod_num' => $row[7],
            'entry_date' => new Carbon($row[8]),
            'updated_date' => new Carbon($row[9]),
            'temp' => $row[10],
            'FMS' => $row[11],
            'active' => $row[12],
            'fms_flag' => $row[13],
            'company' => $row[14],
            'action' => $row[15],
            'trans_flag' => $row[16],
            'cases_count' => $row[17],
            'branch_code' => $row[18],
            'eng_num_back' => $row[19],
            'bod_num_back' => $row[20],
            'regisration_date' => new Carbon($row[21]),
            'ending_km' => $row[22],
        ]);
    }
}
