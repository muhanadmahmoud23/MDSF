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
        $requestData = $runCode = $request->requestData;
        $salesRepId = $request->salesRepId;
        $posCode = $request->posCode;
        $creditLimit = $request->creditLimit;
        $tablename = $request->tablename;
        $runCodeQuery = $request->runCodeQuery;
        $flexSwitchCheckChed = $request->flexSwitchCheckChed;
        $data['status'] = 'error';
        $data['message'] = 'برجاء التاكد من البيانات';
        $data['result'] = null;
			


        //SalesRep Check Validation 
        $allSalesRep = DB::connection('oracle2')->table('VER_CTRL')->where('SALESREP_ID', $salesRepId)->first();
        if ($allSalesRep == []) {
            return response()->json([
                'status' => 'error',
                'message' => 'كود المندوب غير صحيح',
                'result' => null
            ]);
        }

        //Checkbox All = True
        // if()

        $requestData = $runCode;
        // Manual Table Name & Manual Query Run Code
        if ($requestData == 'Query') {
            helper_update_table($salesRepId, $tablename, $runCodeQuery);

            return response()->json([
                'status' => 'success',
                'message' => 'table name = ' . $tablename . ' & ' . 'runCodeQuery = ' . $runCodeQuery,
                'result' => sync_data_by_salesrep_id($salesRepId),
            ]);
        }

        $requestData = $runCode;
        //Paramters Table 
        if ($requestData == 'فتح احداثيات جميع العملاء' || $requestData == 'الزيارات الخارجية' || $requestData == 'عودة' || $requestData == 'الغاء فاتورة بحافز' || $requestData == 'فتح أضافة بيع' || $requestData == 'GPS & Near' || $requestData == 'فتح التحميل للغير مباشر' || $requestData  = "فتح عدد البيع" || $requestData = "زيادة عدد الزيارات") {
            $data = ParamtersTable($salesRepId, $runCode);
        }

        //updatePOS
        $requestData = $runCode;
        if ($requestData == 'تفعيل الحد الأئتمانى' || $requestData == 'تفعيل الفترة الأئتمانية') {
            $data = updatePOS($salesRepId, $posCode, $runCode);
        }

        //Unique Paramters
        $requestData = $runCode;
        if ($requestData == 'FIXED_INCENTIVE_DETAILS' || $requestData == 'تحديث محلات' | $requestData == 'INCENTIVE_GRAD_DEATILS' || $requestData == 'target' || $requestData == "FIX" || $requestData == "INCENTIVE_MIX" || $requestData == 'مشاكل الطباعة') {
            $data = UniqueParamters($salesRepId, $runCode);
        }

        //زيادة قيمة الحد الأئتمانى
        $requestData = $runCode;
        if ($requestData == 'زيادة قيمة الحد الأئتمانى') {
            if ($creditLimit && $posCode) {
                helper_update_table($salesRepId, 'POS', 'set pos_creditlimit = ' . $creditLimit . ' where POS_CODE ="' . $posCode . '"');
                $data['status'] = 'success';
                $data['message'] = 'تم فتح الاحداثيات   ';
                $data['result'] = sync_data_by_salesrep_id($salesRepId);
            } elseif (!$posCode) {
                $data['message'] = 'برجاء التاكد كود العميل';
            } elseif (!$creditLimit) {
                $data['message'] = 'برجاء التاكد الحد الاتمانية ';
            }
        }

        //فتح احداثيات
        $requestData = $runCode;
        if ($requestData == 'فتح احداثيات' && $salesRepId) {
            $data = coordinates($salesRepId, $posCode);
        }

        //Search
        $requestData = $runCode;
        if ($requestData == 'search' && $salesRepId) {
            $data['status'] = 'success';
            $data['message'] = $salesRepId;
            $data['result'] = sync_data_by_salesrep_id($salesRepId);
        }

        return response()->json([
            'status' => $data['status'],
            'message' => $data['message'],
            'result' => $data['result']
        ]);
    }
}
