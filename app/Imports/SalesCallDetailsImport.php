<?php

namespace App\Imports;

use App\Models\SalesCallDetail;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class SalesCallDetailsImport implements ToModel
{

    public function model(array $row)
    {
        return new SalesCallDetail([
            'salescall_id'=>$row[0],
            'salescall_details_id'=>$row[1],
            'category_id'=>$row[2],
            'payment_id'=>$row[3],
            'total_invoice'=>$row[4],
            'incentive_amount'=>$row[5],
            'net_amout'=>$row[6],
            'tax_amount'=>$row[7],
            'phone'=>$row[8],
            'name'=>$row[9],
            'address'=>$row[10],
            'email'=>$row[11],
            'oursource_order'=>$row[12],
        ]);
    }
}
