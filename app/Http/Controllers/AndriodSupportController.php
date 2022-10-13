<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AndriodSupportController extends Controller
{
    public function DevAndriodIndex()
    {
        return view('AndriodSupport.DevAndriod');
    }

    public function DevAndriodInvoice(Request $request)
    {
        $salesRepId = $request->salesRepId;
        $runCode = $request->runCode;
        $tabName = $request->tabName;
        $result = "Missing Paramters";
        $message ="Empty";

        if ($salesRepId && $runCode == "search") {
            $result = sync_data_by_salesrep_id($salesRepId);
        }elseif($salesRepId && $tabName == "FIXED_INCENTIVE_DETAILS" || $tabName == "TARGET" || $tabName =="INCENTIVE_GRAD_DEATILS" || $tabName =="INCENTIVE_MIX" ){
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
        } 
        elseif ($runCode == 'تحديث محلات' && $salesRepId) {
            helper_update_table($salesRepId, 'INCENTIVE_GRAD_DETAILS', null);
            helper_update_table($salesRepId, 'POS', null);
            helper_update_table($salesRepId, 'TARGET', null);
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($salesRepId && $runCode && $tabName && $request->posCode !=null) {
            if($request->posCode !== "Missing POS"){
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
        }
        } elseif ($salesRepId && $runCode && $tabName) {
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
        }
        return response()->json(['result' => $result , 'message' => $message]);
    }
}
