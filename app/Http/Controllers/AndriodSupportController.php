<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AndriodSupportController extends Controller
{
    public function DevAndriodIndex()
    {
        // $tablenames = DB::connection('oracle2')->table('TAB_LOADING')->get();

        return view('AndriodSupport.DevAndriod',[
            // 'tablenames'  =>  $tablenames,
        ]);
    }

    public function DevAndriodInvoice(Request $request)
    {
        $salesRepId = $request->salesRepId;
        $runCode = $request->runCode;
        $tabName = $request->tabName;
        $runCodeQuery = $request->runCodeQuery;
        $tablename = $request->tablename;
        $result = "Missing Paramters";
        $message = "Empty";

        if ($salesRepId && $runCode == "search") {
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($salesRepId && $tabName == "FIXED_INCENTIVE_DETAILS" || $tabName == "TARGET" || $tabName == "INCENTIVE_GRAD_DEATILS" || $tabName == "INCENTIVE_MIX") {
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
        }elseif ($runCode=='Query' && $salesRepId && $tablename) {
                helper_update_table($salesRepId,$tablename,$runCodeQuery);
                $result = sync_data_by_salesrep_id($salesRepId);
        }
         elseif ($runCode == 'فتح عدد البيع' && $salesRepId) {
            helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 0 where param_id = 62');
            helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 999 where param_id = 63');
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($runCode == 'تحديث محلات' && $salesRepId) {
            helper_update_table($salesRepId, 'INCENTIVE_GRAD_DETAILS', null);
            helper_update_table($salesRepId, 'POS', null);
            helper_update_table($salesRepId, 'TARGET', null);
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($runCode == 'مشاكل الطباعة' && $salesRepId) {
            helper_update_table($salesRepId, 'INC_MST', null);
            helper_update_table($salesRepId, 'Pricelist', null);
            helper_update_table($salesRepId, 'FUEL_PRICE', null);
            helper_update_table($salesRepId, 'DISPLAY_UOM', null);
            helper_update_table($salesRepId, 'TAB_LOADING', null);
            helper_update_table($salesRepId, 'MENU_ITEMS', null);
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($salesRepId && $runCode && $tabName && $request->posCode != null) {
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($salesRepId && $runCode && $tabName) {
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
        }
        return response()->json(['result' => $result, 'message' => $message]);
    }
}
