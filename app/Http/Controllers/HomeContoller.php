<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeContoller extends Controller
{
    public function home()
    {   
        return view('home');
    }
}
