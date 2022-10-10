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

    public function DevAndriodInvoice($salesRepId,$runCode,$tabName)
    {
        $result = "Missing Paramters";

        if ($salesRepId && $runCode && $tabName) {
            if($runCode == "search"){
                $result = sync_data_by_salesrep_id($salesRepId);
            }
            else{
            helper_update_table(1664, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
        }
        }
        return response()->json(['result' => $result]);
    }
}
