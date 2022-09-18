<?php

namespace App\Http\Controllers;

use App\Models\ACCOUNTS;
use App\Models\BRANCHES;
use App\Models\GEN_ACTIVE_SALESREP_INFO;
use App\Models\POS;
use App\Models\PRODUCT_COMPANY;
use App\Models\SALES_INVOICE_PRINT_FINE;
use App\Models\SALES_TERRITORIES_ACTIVE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;


class PrintInvoiceController extends Controller
{

    public function printInvoiceIndex()
    {

        $branches = BRANCHES::select('BRANCH_CODE', 'BRANCH_NAME')
            ->get();

        $companies = PRODUCT_COMPANY::select('COMPANY_ID', 'COMPANY_NAME')
            ->where('COMPANY_FLAG', 1)
            ->where('COMPANY_SEQ', '!=', null)
            ->orderBy('COMPANY_SEQ')
            ->get();

        $accounts = ACCOUNTS::select('ACC_ID', 'ACC_DESC')
            ->orderBy('ACC_DESC')
            ->distinct()
            ->get();

        return view(
            'sales.invoicePrint',
            [
                'branches'  => $branches,
                'companies' => $companies,
                'accounts'  => $accounts
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
        $PrintInvoiceResult = "";
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
        if ($PrintInvoiceResult != "") {
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
}
