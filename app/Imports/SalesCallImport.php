<?php

namespace App\Imports;

use App\Models\SalesCall;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class SalesCallImport implements ToModel
{

    public function model(array $row)
    {
        return new SalesCall([
            'sales_call_id'=>$row[0],
            'sales_ter_id'=>$row[1],
            'jou_id'=>$row[2],
            'pos_code'=>$row[3],
            'route_id'=>$row[4],
            'call_status_id'=>$row[5],
            'reason_id'=>$row[6],
            'start_time'=> new Carbon($row[7]),
            'end_time'=>new Carbon($row[8]),
            'payment_id'=>$row[9],
            'total_invoice'=>$row[10],
            'incentive_amount'=>$row[11],
            'net_amount'=>$row[12],
            'tax_amount'=>$row[13],
            'branch_code'=>$row[14],
        ]);
    }
}
