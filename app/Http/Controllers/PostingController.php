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

        DB::table('TEST_S_D_ALL_MST')->truncate();

        //Data Initalize 
        $dateFrom = $request->Begindate;
        $dateEnd = $request->endDate;
        $branches = $request->branches;
        $branchNames = "";
        $SALESCALLS_ID = [];
        $currentMonth = date('m');
        $currentYear = date('Y');
        $currentDay = date('d');
        $randomNumber = random_int(1000, 9999);
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
            if ($branchExist = 0) {
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

                        $MST_ID = $branch->branch_code . $currentYear . $currentMonth . $currentDay . $randomNumber;

                        $salescalls = $DB->table('SALESCALL')
                            ->select(
                                'SALES_ANDROID_V4.CALL_STATUS_ID',
                                'SALES_ANDROID_V4.TER_ID',
                                'SALES_ANDROID_V4.POS_ID',
                                'SALES_ANDROID_V4.SALES_TER_ID',
                                'SALESCALL.ROUTE_ID',
                                'SALES_ANDROID_V4.ROUTE_TYPE_ID',
                                'SALES_ANDROID_V4.DAY',
                                'SALES_ANDROID_V4.SALESREP_ID',
                                'SALESCALL.REASON_ID',
                                'SALES_ANDROID_V4.CAT_ID',
                                'SALESCALL.SALESCALL_ID',
                                'SALESCALL.JOU_ID',
                                'SALES_ANDROID_V4.VISIT_START_TIME',
                                'SALES_ANDROID_V4.VISIT_END_TIME'
                            )
                            ->whereBetween(DB::RAW("to_date(SALESCALL.START_TIME,'dd-mon-yyyy hh:mi:ss AM')"), [$dateFrom, $dateEnd])
                            ->where('SALES_ANDROID_V4.BRANCH_CODE', $branch->branch_code)
                            ->where('SALESCALL.CALL_STATUS_ID', 'S')
                            ->join('SALES_ANDROID_V4', 'SALESCALL.POS_CODE', '=', 'SALES_ANDROID_V4.POS_CODE')
                            ->take(1)
                            ->get();

                        if ($salescalls) {
                            foreach ($salescalls as $salescall) {
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