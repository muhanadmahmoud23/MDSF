<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('helper_get_quantity')) {
    function helper_get_quantity($QuantityMeasure)
    {
        if ($QuantityMeasure == 'sales') {
            $quantity = 'sales as quantity';
        } elseif ($QuantityMeasure == 'sales_2') {
            $quantity = 'sales2 as quantity';
        } else {
            $quantity = 'sales_car as quantity';
        }
        return $quantity;
    }
}

if (!function_exists('get_data_pivot_table')) {
    function get_data_pivot_table($paramters, $quantity, $column, $variable, $Dateby, $Begindate, $endDate)
    {
        if ($paramters) {
            $Result = DB::connection('oracle2')->table('SALES_ANDROID_V4')
                ->select(
                    'salesrep_name',
                    'pos_name',
                    'pos_code',
                    'visit_start_time',
                    'visit_end_time',
                    'company_name',
                    $quantity,
                    'DAY',
                    'VISIT_DAY',
                    'prod_seq',
                    'prod_id',
                    'product',
                    'FAMILY_SEQ',
                    'PROD_FAMILY',
                    'total_invoice'
                )
                ->whereIn($column, $variable)
                ->whereBetween($Dateby, [$Begindate, $endDate])
                ->distinct()
                ->get();

            return $Result;
        }
        return "Missing Paramter";
    }

    if (!function_exists('helper_update_table')) {
        function helper_update_table($SALESREP_ID, $TAB_NAME, $RUN_CODE)
        {
            DB::insert('insert into SYNC_DATA_SALESREP@SALES (SALESREP_ID, TAB_NAME, RUN_CODE) values (?, ?,?)', [
                $SALESREP_ID, $TAB_NAME, $RUN_CODE
            ]);
        }
    }
    if (!function_exists('sync_data_by_salesrep_id')) {
    function sync_data_by_salesrep_id($salesrep_id){
       $result =  DB::connection('oracle2')->table('SYNC_DATA_SALESREP')->select('*')->where('SALESREP_ID',$salesrep_id)->orderBy('COMM_DATE','DESC')->get();
       return $result;
    }

    }
}
