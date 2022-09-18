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
    public function postSalesCall ()
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
        Excel::import(new POSImport, request()->file('POSExcel'));
        return redirect()->route('Excel')->with('message', 'POS Added Succefully!!');
    }
}
