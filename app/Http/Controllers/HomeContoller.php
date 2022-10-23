<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeContoller extends Controller
{
    public function home()
    {
        // $TOTAL_INVOICE = DB::connection('oracle2')->table('SALES_ANDROID_V4')->select('TOTAL_INVOICE')->div('COMPANY_NAME', 'ITG')->first();
        // dd($TOTAL_INVOICE);

        return view('home');
    }
}
