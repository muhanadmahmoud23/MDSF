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

    public function GetOrderWhereSalesMenAndData(Request $request)
    {
        $salesRepId = $request->salesRepId;
        $beginDate = $request->Begindate;
        $endDate = $request->endDate;
        $salesMen = $request->SalesMen;
        $loadingNumber = $request->loadingNumber;
        $Company = $request->CompanyAjax;
        $allDetails = true;
        $result = null;


        if ($allDetails == false) {
            $tablename = DB::table('LOADING_AND_UNLOADING_V');
        } else {
            $tablename = DB::table('TRAC_LOG_INV');
        }

        if ($loadingNumber) {
            //SalesRep Check Validation 
            $loadingNumberCheck = checkloadingNumberExist($loadingNumber);
            if ($loadingNumberCheck == 0) {
                $status = 'error';
                $message = 'Wrong Loading Number';
            }
            //Get Where SalesRep
            else {
                $result = $tablename->where('LOADING_NUMBER', $loadingNumber);
                if ($result) {
                    $status = 'success';
                    $message = 'Data Retrived Succefully';
                } else {
                    $status = 'error';
                    $message = 'Do Data Found!';
                }
            }
        } elseif ($salesRepId) {
            //SalesRep Check Validation 
            $SalesMan = checkSalesManExist($salesRepId);
            if ($SalesMan == 0) {
                $status = 'error';
                $message = 'كود المندوب غير صحيح';
            }
            //Get Where SalesRep
            else {
                $result = $tablename->where('SALESREP_ID', $salesRepId);

                if ($result) {
                    $status = 'success';
                    $message = 'Data Retrived Succefully';
                } else {
                    $status = 'error';
                    $message = 'Do Data Found!';
                }
            }
        } elseif ($salesMen) {
            $result =  $tablename->whereIn('SALESREP_ID', $salesMen);

            if ($Company) {
                $result = $result->whereIn('DIV', $Company);
            }

            if ($result) {
                $status = 'success';
                $message = 'Data Retrived Succefully';
            } else {
                $status = 'error';
                $message = 'Do Data Found!';
            }
        } else {
            $status = 'error';
            $message = 'Missing Paramter!';
        }

        if ($result) {

            $result = $result->get();
        }
        return response()->json([
            'status' => $status,
            'message' => $message,
            'result' => $result,
            'allDetails' => $allDetails,
        ]);
    }
}
