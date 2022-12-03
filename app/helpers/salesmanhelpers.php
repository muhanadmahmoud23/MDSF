<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

if (!function_exists('checkSalesManExist')) {
    function checkSalesManExist($salesRepId)
    {
        $SalesMan = DB::connection('oracle2')->table('VER_CTRL')->where('SALESREP_ID', $salesRepId)->first();
        if ($SalesMan == []) {
            return 1 ;
        }else{
            return $SalesMan;
        }
    }
}
