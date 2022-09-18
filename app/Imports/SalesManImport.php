<?php

namespace App\Imports;

use App\Models\SalesMan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class SalesManImport implements ToModel
{

    public function model(array $row)
    {
        return new SalesMan([
            'sales_id' => $row[0],
            'sales_code' => $row[1],
            'sales_code_char' => $row[2],
            'name' => $row[3],
            'address' => $row[4],
            'tel_num' => $row[5],
            'mobile' => $row[6],
            'martial' => $row[7],
            'occupation' => $row[8],
            'education' => $row[9],
            'birthdate' => new Carbon($row[10]),
            'join_date' => new Carbon($row[11]),
            'status' => $row[12],
            'entry_date' => new Carbon($row[13]),
            'update_date' => new Carbon($row[14]),
            'km' => $row[15],
            'prs' => $row[16],
            'census' => $row[17],
            'key_flag' => $row[18],
            'call_card' => $row[19],
            'action' => $row[20],
            'trans_flag' => $row[21],
            'active' => $row[22],
            'salestype' => $row[23],
            'insurance' => $row[24],
            'branch_code' => $row[25],
            'E_name' => $row[26],
            'dc' => $row[27],
        ]);
    }
}
