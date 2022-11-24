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
        $data['status'] = 'error';
        $data['message'] = 'برجاء التاكد من البيانات';
        $data['result'] = null;

        //Paramters Table 
        if ($requestData == 'فتح احداثيات جميع العملاء' || $requestData == 'فتح الزيارات الخارجية' || $requestData == 'زيادة الزيارات الخارجية' || $requestData == 'عودة' || $requestData == 'الغاء فاتورة بحافز' || $requestData == 'فتح أضافة بيع' || $requestData == 'Near' || $requestData == 'GPS' || $requestData == 'فتح التحميل للغير مباشر' || $requestData  = "فتح عدد البيع" || $requestData = "زيادة عدد الزيارات") {
            $data = ParamtersTable($salesRepId, $runCode);
        }
        //updatePOS
        $requestData = $runCode;
        if ($requestData == 'تفعيل الحد الأئتمانى' || $requestData == 'تفعيل الفترة الأئتمانية') {
            $data = updatePOS($salesRepId, $posCode, $runCode);
        }
        $requestData = $runCode;
        //Unique Paramters
        if ($requestData == 'FIXED_INCENTIVE_DETAILS' || $requestData == 'تحديث محلات' | $requestData == 'INCENTIVE_GRAD_DEATILS' || $requestData == 'target' || $requestData == "FIX" || $requestData == "INCENTIVE_MIX" || $requestData == 'مشاكل الطباعة') {
            $data = UniqueParamters($salesRepId, $runCode);
        }
        $requestData = $runCode;
        //فتح احداثيات
        if ($requestData == 'فتح احداثيات') {
            $data = coordinates($salesRepId, $posCode);
        }

        return response()->json([
            'status' => $data['status'],
            'message' => $data['message'],
            'result' => $data['result']
        ]);
    }
}
