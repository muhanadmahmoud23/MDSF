<?php

namespace App\Http\Controllers;

use App\Http\Traits\DBRetrive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AndriodSupportController extends Controller
{
    use DBRetrive;

    public function DevAndriodIndex()
    {
        $tablenames = DB::connection('oracle2')->table('TAB_LOADING')->get();
        $regions = $this->branches();
        return view('AndriodSupport.DevAndriod', [
            'tablenames'  =>  $tablenames,
            'regions' => $regions,
        ]);
    }

    public function DevAndriodInvoice(Request $request)
    {
        $salesRepId = $request->salesRepId;
        $runCode = $request->runCode;
        $tabName = $request->tabName;
        $runCodeQuery = $request->runCodeQuery;
        $Region = $request->Region;
        $tablename = $request->tablename;
        $result = "Missing Paramters";
        $message = "Empty";

        if ($salesRepId && $runCode == "search") {
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($salesRepId && $tabName == "FIXED_INCENTIVE_DETAILS" || $tabName == "TARGET" || $tabName == "INCENTIVE_GRAD_DEATILS" || $tabName == "INCENTIVE_MIX") {
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($runCode == 'Query' && $salesRepId && $tablename) {
            helper_update_table($salesRepId, $tablename, $runCodeQuery);
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($runCode == 'فتح عدد البيع' && $salesRepId) {
            helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 0 where param_id = 62');
            helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 999 where param_id = 63');
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($runCode == 'تحديث محلات' && $salesRepId) {
            helper_update_table($salesRepId, 'INCENTIVE_GRAD_DETAILS', null);
            helper_update_table($salesRepId, 'POS', null);
            helper_update_table($salesRepId, 'TARGET', null);
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($runCode == 'مشاكل الطباعة') {
            if ($Region !== '0') {
                $SalesRepWhereRegion = DB::connection('oracle2')->table('VER_CTRL')->select('salesrep_id')->where('branch_code', $Region)->get();
                foreach ($SalesRepWhereRegion as $salesrepid) {
                    // helper_update_table($salesrepid, 'INC_MST', null);
                    // helper_update_table($salesrepid, 'Pricelist', null);
                    // helper_update_table($salesrepid, 'FUEL_PRICE', null);
                    // helper_update_table($salesrepid, 'DISPLAY_UOM', null);
                    // helper_update_table($salesrepid, 'TAB_LOADING', null);
                    // helper_update_table($salesrepid, 'MENU_ITEMS', null);
                    $result = " Branch Code = $Region تم ارسال مشاكل الطباعة ل";
                    $message = "region message success";
                }
            } elseif ($salesRepId) {
                helper_update_table($salesRepId, 'INC_MST', null);
                helper_update_table($salesRepId, 'Pricelist', null);
                helper_update_table($salesRepId, 'FUEL_PRICE', null);
                helper_update_table($salesRepId, 'DISPLAY_UOM', null);
                helper_update_table($salesRepId, 'TAB_LOADING', null);
                helper_update_table($salesRepId, 'MENU_ITEMS', null);
                $result = sync_data_by_salesrep_id($salesRepId);
            }
        } elseif ($salesRepId && $runCode && $tabName && $request->posCode != null) {
            helper_update_table($salesRepId, $tabName, $runCode);
            $result = sync_data_by_salesrep_id($salesRepId);
        } elseif ($runCode && $tabName) {
            if ($Region !== '0') {
                $SalesRepWhereRegion = DB::connection('oracle2')->table('VER_CTRL')->select('salesrep_id')->where('branch_code', $Region)->get();
                foreach ($SalesRepWhereRegion as $salesrepid) {
                    // helper_update_table($salesrepid, $tabName, $runCode);
                    $result = " RunCode = $runCode tabName = $tabName تم ارسال ل branch code = $Region";
                    $message = "region message success";
                }
            } elseif ($salesRepId) {
                helper_update_table($salesRepId, $tabName, $runCode);
                $result = sync_data_by_salesrep_id($salesRepId);
            }
        }
        return response()->json(['result' => $result, 'message' => $message]);
    }
}
