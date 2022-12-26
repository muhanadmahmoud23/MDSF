<?php

namespace App\Http\Controllers;

use App\Http\Traits\DBRetrive;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostingController extends Controller
{
    use DBRetrive;
    public function posPostingIndex()
    {

        $branches = $this->branches();

        return view('pos.pospostingindex', [
            'branches' => $branches,
        ]);
    }

    public function posPostingSendData(Request $request)
    {

        //Data Initalize 
        $dateFrom = $request->Begindate;
        $dateEnd = $request->endDate;
        $branches = $request->branches;
        $branchNames = "";
        $SALESCALLS_ID = [];
        $currentMonth = date('m');
        $currentYear = date('Y');
        $currentDay = date('d');
        $randomNumber = random_int(100000, 999999);
        $DB = DB::connection('oracle2');

        //Check Input Data
        if ($dateFrom && $dateEnd && $branches) {
            //Check Date
            if ($dateEnd < $dateFrom) {
                return response()->json([
                    'Status' => 'error',
                    'message' => 'Please enter a valid date form',
                ]);
            }
            //Check Branch
            $branchExist = checkBranchExist($branches);

            if ($branchExist == []) {
                return response()->json([
                    'Status' => 'error',
                    'message' => 'Please enter a valid Branch',
                ]);
            } else {
                //If Successfull
                $branchesDetails = getBranchesIfExist($branches);

                foreach ($branchesDetails as $branch) {
                    $branchNames .= "-" . $branch->branch_name . "- "; //for front end
                    $postHandleBranch = postHandleBranch($branch->branch_code); // Check if any one else is posting
                    if ($postHandleBranch->inprogress == 0) {
                        postHandleBranchUpdate($branch->branch_code, 0, Auth::user()->name); // Posting Flag Update

                        $oldSalesCall = DB::table('TEST_S_D_ALL_MST')
                            ->whereBetween('VISIT_START_TIME', [$dateFrom, $dateEnd])
                            ->where('BRANCH_CODE', $branch->branch_code)
                            ->get();

                        if ($oldSalesCall) {
                            foreach ($oldSalesCall as $call) {
                                DB::table('TEST_S_D_ALL_DTL')->where('MST_ID', $call->mst_id)->delete();
                            }
                        }

                        $salescalls = $DB->table('SALES_ANDROID_V4')
                            ->select(
                                'SALES_ANDROID_V4.CALL_STATUS_ID',
                                'SALES_ANDROID_V4.TER_ID',
                                'SALES_ANDROID_V4.POS_ID',
                                'SALES_ANDROID_V4.SALES_TER_ID',
                                'SALESCALL.ROUTE_ID',
                                'SALESCALL.REASON_ID',
                                'SALES_ANDROID_V4.ROUTE_TYPE_ID',
                                'SALES_ANDROID_V4.DAY',
                                'SALES_ANDROID_V4.JOU_ID',
                                'SALES_ANDROID_V4.SALESREP_ID',
                                'SALES_ANDROID_V4.CAT_ID',
                                'SALES_ANDROID_V4.SALESCALL_ID',
                                'SALES_ANDROID_V4.VISIT_START_TIME',
                                'SALES_ANDROID_V4.VISIT_END_TIME'
                            )
                            ->whereBetween('SALES_ANDROID_V4.VISIT_START_TIME', [$dateFrom, $dateEnd])
                            ->where('SALES_ANDROID_V4.BRANCH_CODE', $branch->branch_code)
                            ->whereIn('SALES_ANDROID_V4.CALL_STATUS_ID', ['S','V'])
                            ->join('SALESCALL', DB::RAW("to_date(SALESCALL.START_TIME,'dd-mon-yyyy hh:mi:ss AM')"), '=', 'SALES_ANDROID_V4.VISIT_START_TIME')
                            ->get();

                        if ($salescalls) {

                            foreach ($salescalls as $salescall) {
                           
                                $MST_ID = $branch->branch_code . $currentYear . $currentMonth . $currentDay . $randomNumber;
                                $salescall->ter_id == null ? $salescall->ter_id = 0 : null;
                                // $JOU_ID = DB::table('ROUTE_POS_REASSIGN_ANDR')
                                // ->select('new_jou_id')
                                // ->where('salescall_id',$salescall->salescall_id)
                                // ->where('pos_id', $salescall->pos_id)
                                // ->where('ter_id', $salescall->ter_id)
                                // ->distinct()
                                // ->get();


                                DB::table('TEST_S_D_ALL_MST')->insert([
                                    'MST_ID' => $MST_ID,
                                    'TER_ID' => $salescall->ter_id,
                                    'POS_ID' => $salescall->pos_id,
                                    'SALES_TER_ID' => $salescall->sales_ter_id,
                                    'SALES_ID' => $salescall->salesrep_id,
                                    'ROUTE_TYPE_ID' => $salescall->route_type_id,
                                    'ROUTE_ID' => $salescall->route_id,
                                    'TRANS_TYPE' => $salescall->reason_id,
                                    'DAY' => $salescall->day,
                                    'BRANCH_CODE' => $branch->branch_code,
                                    'CAT_ID' => $salescall->cat_id,
                                    'SALESCALL_ID' => $salescall->salescall_id,
                                    'JOU_ID' => $salescall->jou_id,
                                    'CALL_STATUS_ID' => 'S',
                                    'VISIT_START_TIME' => $salescall->visit_start_time,
                                    'VISIT_END_TIME' => $salescall->visit_end_time,
                                ]);

                                $salescalls_details = $DB->table('SC_INVOICE')
                                    ->where('salescall_id', $salescall->salescall_id)
                                    ->get();



                                if ($salescalls_details) {
                                    foreach ($salescalls_details as $salescallDetail) {
                                        DB::table('TEST_S_D_ALL_DTL')->insert([
                                            'MST_ID' => $MST_ID,
                                            'PROD_ID' => $salescallDetail->prod_id,
                                            'sales' => 1,
                                            'stock' => 1,
                                            'push_stock' => 1,
                                            'day' => $salescall->day,
                                            'branch_code' => $branch->branch_codel
                                        ]);
                                    }
                                }
                            }

                            postHandleBranchUpdate($branch->branch_code, 0, Auth::user()->name); // Posting Flag Update

                            return response()->json([
                                'Status' => 'success',
                                'branches' => $branchNames . " Posted Succefully    ",
                            ]);
                        }

                    } else {
                        return response()->json([
                            'Status' => 'error',
                            'message' => $postHandleBranch->username . " is Posting Brach Code " . $postHandleBranch->branch_code,
                        ]);
                    }
                }

            }

        } else {
            //If Missing Data
            return response()->json([
                'Status' => 'error',
                'message' => 'Missing Paramter',
            ]);
        }
    }
}