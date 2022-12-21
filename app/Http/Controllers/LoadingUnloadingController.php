<?php

namespace App\Http\Controllers;

use App\Http\Traits\DBRetrive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoadingUnloadingController extends Controller
{
    use DBRetrive;
    
    public function orderIndex()
    {
        $branches = $this->branches();
        $companies = FineTobComapinesSelect();

        return view('LoadingUnloading/Order', [
            'branches' => $branches,
            'companies' => $companies,

        ]);
      
    }

    public function GetOrderWhereSalesMenAndData(Request $request){
        if ($request->Begindate && $request->endDate && $request->SalesMen) {
            $SaleTerrResult = DB::connection('oracle2')->table('SALES_ANDROID_V4')
                ->select(
                    'salesrep_name',
                    'pos_name',
                    'pos_code',
                    'visit_start_time',
                    'visit_end_time',
                    'company_name',
                    'DAY',
                    'VISIT_DAY',
                    'prod_seq',
                    'prod_id',
                    'product',
                    'FAMILY_SEQ',
                    'PROD_FAMILY',
                    'total_invoice'
                )
                ->whereIn('SALESREP_ID', $request->SalesMen)             
                ->whereBetween('VISIT_DAY', [$request->Begindate, $request->endDate])
                ->distinct()
                ->get();

            !$SaleTerrResult ? $SaleTerrResult = "Not Found" : null;
        }else{
            $SaleTerrResult = "Missing Paramter";
        }

        return response()->json([
            'SaleTerrResult' =>  $SaleTerrResult,
        ]);
    }
}
