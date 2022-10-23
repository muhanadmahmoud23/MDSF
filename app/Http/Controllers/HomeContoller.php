<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeContoller extends Controller
{
    public function home()
    {   
        $today = Carbon::today();;
        $TOTAL_INVOICE = DB::connection('oracle2')->table('SALES_ANDROID_V4')->select('TOTAL_INVOICE')->where('COMPANY_NAME','ITG')->where('VISIT_DAY',$today)->get();
        dd($TOTAL_INVOICE);

        return view('home',[
            
        ]);
    }
}
