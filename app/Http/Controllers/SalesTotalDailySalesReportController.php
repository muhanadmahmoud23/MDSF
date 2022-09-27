<?php

namespace App\Http\Controllers;

use App\Http\Traits\DBRetrive;
use App\Models\GEN_ACTIVE_SALESREP_INFO;
use App\Models\POS;
use App\Models\SALES_ANDRIOD_V4;
use App\Models\SALES_INVOICE_PRINT_FINE;
use App\Models\SALES_TERRITORIES_ACTIVE;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysqli;

class SalesTotalDailySalesReportController extends Controller
{
    use DBRetrive;
    public function printInvoiceIndex()
    {
        $branches = $this->branches();
        $companies = $this->companies();
        $accounts = $this->accounts();

        return view(
            'sales.invoicePrint',
            [
                'branches'  => $branches,
                'companies' => $companies,
                'accounts'  => $accounts
            ]
        );
    }

    public function SalesRepVisitsIndex()
    {
        $branches = $this->branches();
        $companies = $this->companies();

        return view(
            'sales.salesRepVisits',
            [
                'branches'  => $branches,
                'companies' => $companies,
            ]
        );
    }

    public function DSRIndex()
    {
        $branches = $this->branches();
        $companies = $this->companies();

        return view(
            'sales.DSR',
            [
                'branches'  => $branches,
                'companies' => $companies,
            ]
        );
    }

    public function SalesTerr(Request $request)
    {
        $SalesTerr = "";

        if ($request->Branch && $request->Company) {
            $SalesTerr = SALES_TERRITORIES_ACTIVE::select('NAME', 'SALES_TER_ID')
                // ->whereIn('PROD_GROUP_ID', $request->Company)
                ->whereIn('BRANCH_CODE', $request->Branch)
                ->get();
        }

        return response()->json($SalesTerr);
    }

    public function SalesManTerr(Request $request)
    {
        $SalesManTerr = "";

        if ($request->SalesTerrId) {
            $SalesManTerr = GEN_ACTIVE_SALESREP_INFO::select('SALES_ID', 'SALESREP_NAME')
                ->whereIn('SALES_TER_ID', $request->SalesTerrId)
                ->distinct()
                ->orderBy('SALESREP_NAME')
                ->get();
        }

        return response()->json($SalesManTerr);
    }

    public function SalesPrintInvoice(Request $request)
    {
        $PrintInvoiceResult = "Missing Paramters";
        $totalInvoicesCount = 0;
        $totalIncentiveAmount = 0;
        $totalTotalValue = 0;
        $totalNetAmount = 0;
        $totalTaxAmount = 0;
        $POS_CODE = [];

        if ($request->pos_code && $request->Begindate && $request->endDate) {
            $PrintInvoiceResult = SALES_INVOICE_PRINT_FINE::select(
                'SALESCALL_DETAILS_ID',
                'SALESCALL_ID',
                'CATEGORY_ID',
                'TOTAL_INVOICE',
                'INCENTIVE_AMOUNT',
                'NET_AMOUNT',
                'TAX_AMOUNT',
                'POS_CODE',
                'POS_NAME',
                'VISIT_START_TIME',
                'SALESREP_ID'
            )
                ->where('POS_CODE', $request->pos_code)
                ->whereBetween('VISIT_START_TIME', [$request->Begindate, $request->endDate])
                ->orderBy('VISIT_START_TIME')
                ->distinct()
                ->get();
        } else if ($request->sales_rep && $request->Begindate && $request->endDate) {
            $PrintInvoiceResult = SALES_INVOICE_PRINT_FINE::select(
                'SALESCALL_DETAILS_ID',
                'SALESCALL_ID',
                'CATEGORY_ID',
                'TOTAL_INVOICE',
                'INCENTIVE_AMOUNT',
                'NET_AMOUNT',
                'TAX_AMOUNT',
                'POS_CODE',
                'POS_NAME',
                'VISIT_START_TIME',
                'SALESREP_ID'
            )
                ->where('SALESREP_ID', $request->sales_rep)
                ->whereBetween('VISIT_START_TIME', [$request->Begindate, $request->endDate])
                ->orderBy('VISIT_START_TIME')
                ->distinct()
                ->get();
        } else if ($request->invoice_id && $request->Begindate && $request->endDate) {
            $PrintInvoiceResult = SALES_INVOICE_PRINT_FINE::select(
                'SALESCALL_DETAILS_ID',
                'SALESCALL_ID',
                'CATEGORY_ID',
                'TOTAL_INVOICE',
                'INCENTIVE_AMOUNT',
                'NET_AMOUNT',
                'TAX_AMOUNT',
                'POS_CODE',
                'POS_NAME',
                'VISIT_START_TIME',
                'SALESREP_ID'
            )
                ->where('SALESCALL_DETAILS_ID', $request->invoice_id)
                ->whereBetween('VISIT_START_TIME', [$request->Begindate, $request->endDate])
                ->distinct()
                ->get();
        } else if ($request->Account && $request->Begindate && $request->endDate) {

            $POSFromAccounts = POS::select('ter_id', 'pos_id')
                ->whereIn('ACC_ID', $request->Account)
                ->distinct()
                ->get();

            foreach ($POSFromAccounts as $POSFromAccount) {
                $POS = $POSFromAccount->ter_id . '_' . $POSFromAccount->pos_id;
                array_push($POS_CODE, $POS);
            }
            $PrintInvoiceResult = SALES_INVOICE_PRINT_FINE::select(
                'SALESCALL_DETAILS_ID',
                'SALESCALL_ID',
                'CATEGORY_ID',
                'TOTAL_INVOICE',
                'INCENTIVE_AMOUNT',
                'NET_AMOUNT',
                'TAX_AMOUNT',
                'POS_CODE',
                'POS_NAME',
                'VISIT_START_TIME',
                'SALESREP_ID'
            )
                ->whereIn('POS_CODE', $POS_CODE)
                ->whereBetween('VISIT_START_TIME', [$request->Begindate, $request->endDate])
                ->distinct()
                ->get();
        } else if ($request->SalesMen && $request->Begindate && $request->endDate) {
            $PrintInvoiceResult = SALES_INVOICE_PRINT_FINE::select(
                'SALESCALL_DETAILS_ID',
                'SALESCALL_ID',
                'CATEGORY_ID',
                'TOTAL_INVOICE',
                'INCENTIVE_AMOUNT',
                'NET_AMOUNT',
                'TAX_AMOUNT',
                'POS_CODE',
                'POS_NAME',
                'VISIT_START_TIME',
                'SALESREP_ID'
            )
                ->whereIn('SALESREP_ID', $request->SalesMen)
                ->whereBetween('VISIT_START_TIME', [$request->Begindate, $request->endDate])
                ->orderBy('VISIT_START_TIME')
                ->distinct()
                ->get();
        }
        if ($PrintInvoiceResult != "Missing Paramters") {
            foreach ($PrintInvoiceResult as $result) {
                $totalInvoicesCount = $totalInvoicesCount + 1;
                $totalIncentiveAmount += $result->incentive_amount;
                $totalTotalValue += $result->total_invoice;
                $totalNetAmount += $result->net_amount;
                $totalTaxAmount += $result->tax_amount;
            }
        }
        return response()->json([
            'PrintInvoiceResult' =>  $PrintInvoiceResult,
            'totalInvoicesCount' =>  $totalInvoicesCount,
            'totalTotalValue' => $totalTotalValue,
            'totalIncentiveAmount' => $totalIncentiveAmount,
            'totalNetAmount' => $totalNetAmount,
            'totalTaxAmount' => $totalTaxAmount
        ]);
    }

    public function SalesRepVisitsInvoice(Request $request)
    {
        $SalesRepVisitsResult = "Missing Paramter";

        if ($request->Begindate && $request->endDate && $request->SalesMen) {
            if ($request->VisitTimeDetails == 1) {
                $SalesRepVisitsResult = DB::connection('oracle2')->table('SALES_ANDROID_V4')
                    ->select('SALESREP_NAME', 'VISIT_START_TIME as CALL_DUARTION_BY_MINUTES', 'POS_CODE', 'POS_NAME', 'VISIT_START_TIME', 'VISIT_END_TIME', 'CALL_STATUS_ID')
                    ->whereIn('SALESREP_ID', $request->SalesMen)
                    ->whereBetween($request->DateBy, [$request->Begindate, $request->endDate])
                    ->distinct()
                    ->get();
            } else {


                $sql = "SELECT pos_Tcall.salesrep_name, pos_Tcall.Day_start_date,pos_Tcall.Day_end_date, pos_Tcall.Total_pos_Call  ,pos_Scall.Success_pos_Call,Tcall.Total_Call ,Success_Call, round(60*24 *( pos_Tcall.Day_end_date - pos_Tcall.Day_start_date),2) CALL_DURATION_By_Minutes FROM(select t.salesrep_id,t.salesrep_name,min(visit_start_time)Day_start_date,max(visit_end_time)Day_end_date ,count(distinct pos_code) Total_pos_Call from sales_android_v4@sales T where call_status_id in('S','V') and 'SALESREP_ID' in (113692,4253,112992,84,111088,105829,104756,113872) and'DAY' between '15-Sep-2022'and '21-Sep-2022'group by t.salesrep_name,t.salesrep_id)pos_Tcall,(select s.salesrep_name, count(distinct pos_code) Success_pos_Call from sales_android_v4@sales s where call_status_id ='S' and 'SALESREP_ID' in (113692,4253,112992,84,111088,105829,104756,113872) and'DAY' between '21-Sep-2022'and '21-Sep-2022'group by s.salesrep_name)pos_Scall,(select v.salesrep_name, count(distinct pos_code) Visit_pos_Call from sales_android_v4@sales v where call_status_id ='V' and'SALESREP_ID' in (113692,4253,112992,84,111088,105829,104756,113872) and'DAY' between '21-Sep-2022'and '21-Sep-2022'group by v.salesrep_name)pos_Vcall , (select t.salesrep_name,min(visit_start_time)Day_start_date,max(visit_end_time)Day_end_date ,count(distinct salescall_id) Total_Call from sales_android_v4@sales T where call_status_id in('S','V') and   'SALESREP_ID' in (113692,4253,112992,84,111088,105829,104756,113872)  and  'DAY' between '21-Sep-2022'and '21-Sep-2022'group by t.salesrep_name)Tcall,(select s.salesrep_name, count(distinct salescall_id) Success_Call from sales_android_v4@sales s where call_status_id ='S' and  'SALESREP_ID' in (113692,4253,112992,84,111088,105829,104756,113872)  and  'DAY' between '21-Sep-2022'and '21-Sep-2022'group by s.salesrep_name)Scall";
                // dd($sql);
                // $sql='select * 
                // from LOADING_HEADER where 
                // SALESREP_ID= 109988 ';
                $SalesRepVisitsResult = DB::select($sql);
                dd($SalesRepVisitsResult);
            }
        }

        return response()->json([
            'SalesRepVisitsResult' =>  $SalesRepVisitsResult,

        ]);
    }

    public function DSRInvoice(Request $request)
    {
        $DSRResult = "Missing Paramter";
        if($request->Begindate && $request->endDate && $request->SalesMen && $request->DateBy && $request->SalesBy && $request->QuantityMeasure){
            $DSRResult = DB::connection('oracle2')->table('SALES_ANDROID_V4')
            ->select('*')
            ->whereIn('SALESREP_ID', $request->SalesMen)
            ->whereBetween($request->DateBy, [$request->Begindate, $request->endDate])
            ->distinct()
            ->get();
        }

        return response()->json([
            'DSRResult' =>  $DSRResult,

        ]);
    }
}
