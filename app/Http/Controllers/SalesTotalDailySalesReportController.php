<?php

namespace App\Http\Controllers;

use App\Http\Traits\DBRetrive;
use App\Models\GEN_ACTIVE_SALESREP_INFO;
use App\Models\POS;
use App\Models\POS_INF;
use App\Models\SALES_INVOICE_PRINT_FINE;
use App\Models\SALES_TERRITORIES_ACTIVE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

    public function POSIndex()
    {
        $branches = $this->branches();
        $companies = $this->companies();
        return view(
            'sales.POS',
            [
                'branches'  => $branches,
                'companies' => $companies,
            ]
        );
    }

    public function SalesRepIndex()
    {
        $branches = $this->branches();
        $companies = $this->companies();
        return view(
            'sales.SalesRep',
            [
                'branches'  => $branches,
                'companies' => $companies,
            ]
        );
    }

    public function SaleTerrIndex()
    {
        $branches = $this->branches();
        $companies = $this->companies();
        return view(
            'sales.SalesTerr',
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

    public function POSSalesManTerr(Request $request)
    {
        $POS_SALESMEN = "";
        if ($request->SalesMen) {
            $POS_SALESMEN = POS_INF::select('NAME', DB::raw("ter_id||'_'||pos_id as POS_CODE"))
                ->whereIn('CURR_SALES_ID', $request->SalesMen)
                ->distinct()
                ->orderBy('NAME')
                ->get();
        }

        return response()->json($POS_SALESMEN);
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

        $quantity = helper_get_quantity($request->QuantityMeasure);
        $paramters = $request->Begindate && $request->endDate && $request->SalesMen && $request->DateBy && $request->SalesBy && $request->QuantityMeasure;
        $DSRResult = get_data_pivot_table($paramters, $quantity, 'SALESREP_ID', $request->SalesMen, $request->DateBy, $request->Begindate, $request->endDate);

        return response()->json([
            'DSRResult' =>  $DSRResult,
            'SalesByType' => $request->SalesBy,

        ]);
    }

    public function POSInvoice(Request $request)
    {
        $POSResult = "Missing Paramter";

        $quantity = helper_get_quantity($request->QuantityMeasure);
        $paramters = $request->Begindate && $request->endDate && $request->DateBy && $request->SalesBy && $request->QuantityMeasure && $request->POSSalesTerrAjax;
        $POSResult = get_data_pivot_table($paramters, $quantity, 'POS_CODE', $request->POSSalesTerrAjax, $request->DateBy, $request->Begindate, $request->endDate);

        return response()->json([
            'POSResult' =>  $POSResult,
            'SalesByType' => $request->SalesBy,

        ]);
    }

    public function SalesRepInvoice(Request $request)
    {
        $SalesRepResult = "Missing Paramter";

        $quantity = helper_get_quantity($request->QuantityMeasure);
        $paramters = $request->Begindate && $request->endDate && $request->SalesMen && $request->DateBy && $request->SalesBy && $request->QuantityMeasure;
        $SalesRepResult = get_data_pivot_table($paramters, $quantity, 'SALESREP_ID', $request->SalesMen, $request->DateBy, $request->Begindate, $request->endDate);

  
        return response()->json([
            'SalesRepResult' =>  $SalesRepResult,
            'SalesByType' => $request->SalesBy,

        ]);
    }

    public function SaleTerrInvoice(Request $request)
    {
        $SaleTerrResult = "Missing Paramter";

        $quantity = helper_get_quantity($request->QuantityMeasure);

        if ($request->Begindate && $request->endDate && $request->SalesTerr && $request->DateBy && $request->SalesBy && $request->QuantityMeasure) {
            $SaleTerrResult = DB::connection('oracle2')->table('SALES_ANDROID_V4')
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
                ->whereIn('SALES_TER_ID', $request->SalesTerr)
                ->whereBetween($request->DateBy, [$request->Begindate, $request->endDate])
                ->distinct()
                ->get();
        }
        return response()->json([
            'SaleTerrResult' =>  $SaleTerrResult,
            'SalesByType' => $request->SalesBy,

        ]);
    }
}
