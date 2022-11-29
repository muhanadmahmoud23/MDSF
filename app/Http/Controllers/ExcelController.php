<?php

namespace App\Http\Controllers;

use App\Imports\JourneyImport;
use App\Imports\POSImport;
use App\Imports\ProdGroupImport;
use App\Imports\SalesCallDetailsImport;
use App\Imports\SalesCallImport;
use App\Imports\SalesManImport;
use App\Imports\SalesMenTerrImport;
use App\Imports\SalesTerrImport;
use App\Imports\VanImport;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;


class ExcelController extends Controller
{
    public function Excel()
    {
        return view('excel.ExcelUpload');
    }
    public function postProdGroup()
    {
        Excel::import(new ProdGroupImport, request()->file('ProdGroupExcel'));
        return redirect()->route('Excel')->with('message', 'Product Group Added Succefully!!');
    }
    public function postSalesTerr()
    {
        Excel::import(new SalesTerrImport, request()->file('SalesTerrExcel'));
        return redirect()->route('Excel')->with('message', 'Sales Terrorties Added Succefully!!');
    }
    public function postVan()
    {
        Excel::import(new VanImport, request()->file('VanExcel'));
        return redirect()->route('Excel')->with('message', 'Van Added Succefully!!');
    }
    public function postSalesMen()
    {
        Excel::import(new SalesManImport, request()->file('SalesMenExcel'));
        return redirect()->route('Excel')->with('message', 'Sales Men Added Succefully!!');
    }
    public function postSalesMenTerr()
    {
        Excel::import(new SalesMenTerrImport, request()->file('SalesMenTerrExcel'));
        return redirect()->route('Excel')->with('message', 'Sales Men Terr Added Succefully!!');
    }
    public function postJourney()
    {
        Excel::import(new JourneyImport, request()->file('JourneyExcel'));
        return redirect()->route('Excel')->with('message', 'Journey Added Succefully!!');
    }
    public function postSalesCall()
    {
        Excel::import(new SalesCallImport, request()->file('SalesCallExcel'));
        return redirect()->route('Excel')->with('message', 'Sales Call Added Succefully!!');
    }
    public function postSalesCallDetails()
    {
        Excel::import(new SalesCallDetailsImport, request()->file('SalesCallDetailsExcel'));
        return redirect()->route('Excel')->with('message', 'Sales Call Details Added Succefully!!');
    }
    public function postPOS()
    {
        // Excel::import(new POSImport, request()->file('POSExcel'));
        // return redirect()->route('Excel')->with('message', 'POS Added Succefully!!');
    }

    public function importView(Request $request)
    {
        return view('excel.target');
    }

    public function import(Request $request)
    {

        dd('get_taget_type');

        $excelData = Excel::toArray([], $request->file('file')->store('files'))[0]; // store excell in array
        $excelColumnName = $excelData[0]; //get excel cloumn name 
        $excelColumnCount = count($excelData);
        $excelrowCount = count($excelColumnName);
        $tableName = 'cities';

        //Trauncate Table
        $visitors = DB::table($tableName);
        $visitors->truncate();

        // check if cloumn exist -- if(no) => add
        foreach ($excelColumnName as $column) {
            $isColExist = Schema::hasColumn($tableName, $column);
            if (!$isColExist) {
                $newColumnName = $column;
                Schema::table($tableName, function (Blueprint $table) use ($newColumnName) {
                    $table->decimal($newColumnName, 12, 8);
                });
            }
        }

        //add data to table citites
        for ($i = 1; $i < $excelColumnCount; $i++) {
            for ($x = 0; $x < $excelrowCount; $x++) {
                $answers[$excelColumnName[$x]] = $excelData[$i][$x];
            }
            DB::table($tableName)->insert($answers);
        }

        //Get Target Types


        return redirect()->back()->with('success', 'LOLLLLLLLYYYY');;
    }
}
