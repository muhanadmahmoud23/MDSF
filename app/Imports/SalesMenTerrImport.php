<?php

namespace App\Imports;

use App\Models\SalesManTerr;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class SalesMenTerrImport implements ToModel
{
    public function model(array $row)
    {
        return new SalesManTerr([
            'sales_ter_id' =>$row[0],
            'sales_code'=>$row[1],
            'sales_id'=>$row[2],
            'route_type_id'=>$row[3],
            'name'=>$row[4],
            'position'=>$row[5],
            'address'=>$row[6],
            'tel_num'=>$row[7],
            'mobile'=>$row[8],
            'martial'=>$row[9],
            'occupation'=>$row[10],
            'education'=>$row[11],
            'birthdate'=>new Carbon($row[12]),
            'join_date'=> new Carbon($row[13]),
            'van_id'=>$row[14],
            'status'=>$row[15],
            'manager_id'=>$row[16],
            'sales_code_char'=>$row[17],
            'from_date'=>new Carbon($row[18]),
            'to_date'=>new Carbon($row[19]),
            'entry_date'=>new Carbon($row[20]),
            'updated_date'=>new Carbon($row[21]),
            'active'=>$row[22],
            'handover_date'=>$row[23],
            'handover_posting_date'=>$row[24],
            'action'=>$row[25],
            'trans_flag'=>$row[26],
            'branch_code'=>$row[27],
        ]);
    }
}
