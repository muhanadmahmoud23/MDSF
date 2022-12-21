<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function salesTerrWhereRegion(Request $request){
        $salesTerr = GetSalesTerrWhereRegionAndCompanies($request->branch,null);
        return response()->json($salesTerr);
    }

    public function salesMenWhereSalesTerr(Request $request){
        $salesMen = SalesMenWhereSalesTerr($request->salesTerr);
        return response()->json($salesMen);
    }
}
