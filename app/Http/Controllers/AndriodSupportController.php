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
        $salesRepId = 1664;
        $runCode = $request->runCode;
        $tabName = $request->tabName;
        $result = "Missing Paramters";
        $message ="Empty";

        if ($salesRepId && $runCode == "search") {
            $result = sync_data_by_salesrep_id($salesRepId);
        }elseif($salesRepId && $tabName == "FIXED_INCENTIVE_DETAILS" || $tabName == "TARGET" || $tabName =="INCENTIVE_GRAD_DEATILS" || $tabName =="INCENTIVE_MIX" ){
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
            $message = "done";
        } 
        elseif ($runCode == 'تحديث محلات' && $salesRepId) {
            helper_update_table($salesRepId, 'INCENTIVE_GRAD_DETAILS', null);
            helper_update_table($salesRepId, 'POS', null);
            helper_update_table($salesRepId, 'TARGET', null);
            $result = sync_data_by_salesrep_id($salesRepId);
            $message = "done";
        } elseif ($salesRepId && $runCode && $tabName && $request->posCode !=null) {
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
            $message = "done";
        } elseif ($salesRepId && $runCode && $tabName) {
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
            $message = "done";
        }
        return response()->json(['result' => $result , 'message' => $message]);
    }

    public function devandriod(Request $request)
    {
        $result = "Missing Paramters";
        $salesRepId = $request->salesRepId = 1664;
        $buttonDesc = $request->buttonDesc;

        if ($buttonDesc == 'الغاء فاتورة') {
            $tabName = 'PARAMTERS';
            $runCode = 'set param_val = 0 where param_id = 22';
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
        }elseif($buttonDesc == 'عودة'){
            $tabName = 'PARAMTERS';
            $runCode = 'set param_val = 0 where param_id = 13';
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);  
        }
        return response()->json(['result' => $result]);
    }
}
