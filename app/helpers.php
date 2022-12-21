<?php

use App\Models\GEN_ACTIVE_SALESREP_INFO;
use App\Models\SALES_TERRITORIES_ACTIVE;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Traits\DBRetrive;


if (!function_exists('helper_get_quantity')) {
    function helper_get_quantity($QuantityMeasure)
    {
        if ($QuantityMeasure == 'sales') {
            $quantity = 'sales as quantity';
        } elseif ($QuantityMeasure == 'sales_2') {
            $quantity = 'sales2 as quantity';
        } else {
            $quantity = 'sales_car as quantity';
        }
        return $quantity;
    }
}

if (!function_exists('get_data_pivot_table')) {
    function get_data_pivot_table($paramters, $quantity, $column, $variable, $Dateby, $Begindate, $endDate)
    {
        if ($paramters) {
            $Result = DB::connection('oracle2')->table('SALES_ANDROID_V4')
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
                ->whereIn($column, $variable)
                ->whereBetween($Dateby, [$Begindate, $endDate])
                ->distinct()
                ->get();

            return $Result;
        }
        return "Missing Paramter";
    }

    if (!function_exists('helper_update_table')) {
        function helper_update_table($SALESREP_ID, $TAB_NAME, $RUN_CODE)
        {
            DB::insert('insert into SYNC_DATA_SALESREP@SALES (SALESREP_ID, TAB_NAME, RUN_CODE,USER_ID, USER_NAME) values (?, ?,?,?,?)', [
                $SALESREP_ID,
                $TAB_NAME,
                $RUN_CODE, Auth::user()->id, Auth::user()->name
            ]);
        }
    }
    if (!function_exists('sync_data_by_salesrep_id')) {
        function sync_data_by_salesrep_id($salesrep_id)
        {
            $result = DB::connection('oracle2')->table('SYNC_DATA_SALESREP')->select('*')->where('SALESREP_ID', $salesrep_id)->orderBy('COMM_DATE', 'DESC')->get();
            return $result;
        }
    }
    if (!function_exists('get_salesrep_from_sync_data_where_region')) {
        function get_salesrep_from_sync_data_where_region($Region)
        {
            $salesreps = DB::connection('oracle2')->table('VER_CTRL')->select('salesrep_id')->where('branch_code', $Region)->get();
            return $salesreps;
        }
    }

    if (!function_exists('UniqueParamters')) {
        function UniqueParamters($salesRepId, $requestData)
        {
            if ($salesRepId && $requestData == 'FIXED_INCENTIVE_DETAILS') {
                helper_update_table($salesRepId, 'FIXED_INCENTIVE_DETAILS', 'set PAY_FORCE = 0');
                $status = 'success';
                $message = 'تم ايقاف حافز ثابت';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'تحديث محلات') {
                helper_update_table($salesRepId, 'POS', null);
                helper_update_table($salesRepId, 'INCENTIVE_GRAD_DETAILS', null);
                helper_update_table($salesRepId, 'INC_MST', null);
                helper_update_table($salesRepId, 'TARGET', null);
                $status = 'success';
                $message = 'تم ارسال العملاء بنجاح ';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'INCENTIVE_GRAD_DEATILS') {
                helper_update_table($salesRepId, 'INCENTIVE_GRAD_DEATILS', '');
                $status = 'success';
                $message = 'بنجاح INCENTIVE_GRAD_DEATILS  تم ارسال';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'target') {
                helper_update_table($salesRepId, 'TARGET', '');
                $status = 'success';
                $message = 'بنجاح TARGET  تم ارسال';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'FIX') {
                helper_update_table($salesRepId, 'FIXED_INCENTIVE_DETAILS', '');
                $status = 'success';
                $message = 'بنجاح FIX تم ارسال';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'INCENTIVE_MIX') {
                helper_update_table($salesRepId, 'INCENTIVE_MIX', '');
                $status = 'success';
                $message = 'بنجاح INCENTIVE_MIX تم ارسال';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'مشاكل الطباعة') {
                helper_update_table($salesRepId, 'INC_MST', null);
                helper_update_table($salesRepId, 'Pricelist', null);
                helper_update_table($salesRepId, 'FUEL_PRICE', null);
                helper_update_table($salesRepId, 'DISPLAY_UOM', null);
                helper_update_table($salesRepId, 'TAB_LOADING', null);
                helper_update_table($salesRepId, 'MENU_ITEMS', null);
                $status = 'success';
                $message = 'تم ارسال مشاكل الطباعة   ';
                $result = sync_data_by_salesrep_id($salesRepId);
            } else {
                $status = 'error';
                $message = 'برجاء ادخال كود العميل';
                $result = null;
            }
            $data['status'] = $status;
            $data['message'] = $message;
            $data['result'] = $result;

            return $data;
        }
    }

    if (!function_exists('coordinates')) {
        function coordinates($salesRepId, $posCode)
        {
            if ($salesRepId && $posCode) {
                helper_update_table($salesRepId, 'POS', 'set LONGITUDE = 0, LATITUDE = 0 where POS_CODE = "' . $posCode . '"');
                $status = 'success';
                $message = 'تم فتح الاحداثيات بنجاح';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif (!$salesRepId) {
                $status = 'error';
                $message = 'برجاء ادخال كود المندوب';
                $result = null;
            } elseif (!$posCode) {
                $status = 'error';
                $message = 'برجاء ادخال كود العميل';
                $result = null;
            }
            $data['status'] = $status;
            $data['message'] = $message;
            $data['result'] = $result;

            return $data;
        }
    }

    if (!function_exists('ParamtersTable')) {
        function ParamtersTable($salesRepId, $requestData)
        {
            if ($salesRepId && $requestData == 'فتح احداثيات جميع العملاء') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 0 where param_id = 7');
                $status = 'success';
                $message = 'تم فتح الاحداثيات لجميع العملاء';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'الزيارات الخارجية') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 0 where param_id = 16');
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 999 where param_id = 10');
                $status = 'success';
                $message = 'تم فتح الزيارات الخارجية';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'عودة') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 0 where param_id = 13');
                $status = 'success';
                $message = 'تم فتح العودة';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'الغاء فاتورة بدون حافز') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 0 where param_id = 22');
                $status = 'success';
                $message = 'تم فتح الغاء فاتورة بدون حافز';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'الغاء فاتورة بحافز') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 0 where param_id = 18');
                $status = 'success';
                $message = 'تم فتح الغاء فاتور بحافز';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'فتح أضافة بيع') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 1 where param_id = 25');
                $status = 'success';
                $message = 'تم فتح أضافة البيع';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'GPS & Near') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 1 where param_id = 33');
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 0 where param_id = 15');
                $status = 'success';
                $message = 'Near Byتم فتح ال';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'فتح التحميل للغير مباشر') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 1 where param_id = 41');
                $status = 'success';
                $message = 'تم فتح التحميل للغير مباشر';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'فتح عدد البيع') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 0 where param_id = 62');
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 999 where param_id = 63');
                $status = 'success';
                $message = 'تم فتح عدد البيع ';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $requestData == 'زيادة عدد الزيارات') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 999 where param_id = 64');
                $status = 'success';
                $message = 'تم زيادة عدد الزيارات   ';
                $result = sync_data_by_salesrep_id($salesRepId);
            } else {
                $status = 'error';
                $message = 'برجاء ادخال كود المندوب';
                $result = null;
            }

            $data['status'] = $status;
            $data['message'] = $message;
            $data['result'] = $result;

            return $data;
        }
    }

    if (!function_exists('updatePos')) {
        function updatePOS($salesRepId, $posCode, $requestData, $creditLimit)
        {
            if ($salesRepId && $posCode && $requestData == 'تفعيل الحد الأئتمانى') {
                helper_update_table($salesRepId, 'POS', 'set ACTIVE_CREDIT_LIMIT = 0 where POS_CODE ="' . $posCode . '"');
                $status = 'success';
                $message = 'تم فتح الاحداثيات   ';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId && $posCode && $requestData == 'تفعيل الفترة الأئتمانية') {
                helper_update_table($salesRepId, 'POS', 'set ACTIVE_CREDIT_PERIOD = 0 where POS_CODE ="' . $posCode . '"');
                $status = 'success';
                $message = 'تم تفعيل الفترة الأتمانية';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($salesRepId) {
                $status = 'error';
                $message = 'برجاء ادخال كود العميل';
                $result = null;
            } else {
                $status = 'error';
                $message = 'برجاء ادخال كود المندوب';
                $result = null;
            }

            $data['status'] = $status;
            $data['message'] = $message;
            $data['result'] = $result;

            return $data;
        }
    }
}

if (!function_exists('AllPosQueries')) {
    function AllPosQueries($salesRepId, $requestData)
    {
        if ($salesRepId) {
            if ($requestData == 'فتح احداثيات') {
                helper_update_table($salesRepId, 'PARAMETERS', 'set param_val = 0 where param_id = 7');
                $status = 'success';
                $message = 'تم فتح الاحداثيات';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($requestData == 'تفعيل الفترة الأئتمانية') {
                helper_update_table($salesRepId, 'POS', 'set ACTIVE_CREDIT_PERIOD = 0');
                $status = 'success';
                $message = 'تم تفعيل الفترة الأتمانية';
                $result = sync_data_by_salesrep_id($salesRepId);
            } elseif ($requestData == 'تفعيل الحد الأئتمانى') {
                helper_update_table($salesRepId, 'POS', 'set ACTIVE_CREDIT_LIMIT = 0');
                $status = 'success';
                $message = 'تفعيل الحد الأئتمانى';
                $result = sync_data_by_salesrep_id($salesRepId);
            }
        }
        $data['status'] = $status;
        $data['message'] = $message;
        $data['result'] = $result;

        return $data;
    }
}

if (!function_exists('checkSalesManExist')) {
    function checkSalesManExist($salesRepId)
    {
        $SalesMan = DB::connection('oracle2')->table('VER_CTRL')->where('SALESREP_ID', $salesRepId)->first();
        if ($SalesMan == []) {
            return 0;
        } else {
            return 1;
        }
    }
}

if (!function_exists('FineTobComapinesSelect')) {
    function FineTobComapinesSelect()
    {
        $companies = ['FINE', 'TOB'];
        return $companies;
    }
}


if (!function_exists('GetSalesTerrWhereRegionAndCompanies')) {
    function GetSalesTerrWhereRegionAndCompanies($branch, $company)
    {
        $SalesTerr = SALES_TERRITORIES_ACTIVE::select('NAME', 'SALES_TER_ID')
            ->whereIn('BRANCH_CODE', $branch)
            ->get();
        if ($company !== null) {
            $SalesTerr = $SalesTerr->whereIn('PROD_GROUP_ID', $company);
        }

        return $SalesTerr;
    }
}


if (!function_exists('SalesRepWhereSalesTerr')) {
    function SalesMenWhereSalesTerr($SalesTerr)
    {
        $SalesRep = GEN_ACTIVE_SALESREP_INFO::select('SALES_ID', 'SALESREP_NAME')
            ->whereIn('SALES_TER_ID', $SalesTerr)
            ->distinct()
            ->orderBy('SALESREP_NAME')
            ->get();
        return $SalesRep;
    }
}