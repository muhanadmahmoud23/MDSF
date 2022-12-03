<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\DBRetrive;;

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
        $SalesMan = checkSalesManExist($salesRepId);
        if($SalesMan == 1){
            return response()->json([
                'status' => 'error',
                'message' => 'كود المندوب غير صحيح',
                'result' => null
            ]);
        }
        
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


        //Unique Paramters
        $requestData = $runCode;
        if ($requestData == 'FIXED_INCENTIVE_DETAILS' || $requestData == 'تحديث محلات' | $requestData == 'INCENTIVE_GRAD_DEATILS' || $requestData == 'target' || $requestData == "FIX" || $requestData == "INCENTIVE_MIX" || $requestData == 'مشاكل الطباعة') {
            $data = UniqueParamters($salesRepId, $runCode);
        }

        //POS CREDIT VALUES
        $requestData = $runCode;
        if ($requestData == 'تفعيل الحد الأئتمانى' || $requestData == 'تفعيل الفترة الأئتمانية' || $requestData == 'فتح احداثيات') {
            if ($flexSwitchCheckChed == 1) {
                $data = AllPosQueries($salesRepId, $requestData);
            }
            $requestData = $runCode;
            if ($flexSwitchCheckChed == 0) {
                if ($requestData == 'تفعيل الحد الأئتمانى' || $requestData == 'تفعيل الفترة الأئتمانية') {
                    $data = updatePOS($salesRepId, $posCode, $runCode, $creditLimit);
                }
                if ($requestData == 'فتح احداثيات' && $salesRepId) {
                    $data = coordinates($salesRepId, $posCode);
                }

            }
        }
        
        //POS CREDIT VALUE (زيادة قيمة الحد الأئتمانى)
        $requestData = $runCode;
        if ($salesRepId && $posCode && $requestData == 'زيادة قيمة الحد الأئتمانى') {
            if ($creditLimit && $posCode) {
                helper_update_table($salesRepId, 'POS', 'set pos_creditlimit = ' . $creditLimit . ' where POS_CODE ="' . $posCode . '"');
                $data['status'] = 'success';
                $data['message'] = 'تم زيادة قيمة الحد الأئتمانى ';
                $data['result'] = sync_data_by_salesrep_id($salesRepId);
            } elseif (!$posCode) {
                $data['status'] = 'error';
                $data['message'] = 'برجاء التاكد كود العميل';
                $data['result'] = null;
            } elseif (!$creditLimit) {
                $data['status'] = 'error';
                $data['message'] = 'برجاء التاكد الحد الاتمانية ';
                $data['result'] = null;
            }
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
