<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\SalesTotalDailySalesReportController;
use Illuminate\Support\Facades\Route;

//HomePage
Route::get('/', function () { return view('home');})->name('home');

//Excel Uploads
Route::get('Excel' ,[ExcelController::class , 'Excel'])->name('Excel');
Route::post('postProdGroup' ,[ExcelController::class , 'postProdGroup'])->name('postProdGroup');
Route::post('postSalesTerr' ,[ExcelController::class , 'postSalesTerr'])->name('postSalesTerr');
Route::post('postVan' ,[ExcelController::class , 'postVan'])->name('postVan');
Route::post('postSalesMen' ,[ExcelController::class , 'postSalesMen'])->name('postSalesMen');
Route::post('postSalesMenTerr' ,[ExcelController::class , 'postSalesMenTerr'])->name('postSalesMenTerr');
Route::post('postJourney' ,[ExcelController::class , 'postJourney'])->name('postJourney');
Route::post('postSalesCall' ,[ExcelController::class , 'postSalesCall'])->name('postSalesCall');
Route::post('postSalesCallDetails' ,[ExcelController::class , 'postSalesCallDetails'])->name('postSalesCallDetails');
Route::post('postPOS' ,[ExcelController::class , 'postPOS'])->name('postPOS');

//SalesTotalDailySalesReport 
Route::get('printInvoiceIndex', [SalesTotalDailySalesReportController::class , 'printInvoiceIndex'])->name('printInvoiceIndex');
Route::get('SalesRepVisitsIndex', [SalesTotalDailySalesReportController::class , 'SalesRepVisitsIndex'])->name('SalesRepVisitsIndex');
Route::get('DSRIndex', [SalesTotalDailySalesReportController::class , 'DSRIndex'])->name('DSRIndex');

   //Ajax
    Route::get('SalesTerr' ,[SalesTotalDailySalesReportController::class , 'SalesTerr'])->name('SalesTerr');
    Route::get('SalesManTerr' ,[SalesTotalDailySalesReportController::class , 'SalesManTerr'])->name('SalesManTerr');
   //Results
    Route::get('SalesPrintInvoice' ,[SalesTotalDailySalesReportController::class , 'SalesPrintInvoice'])->name('SalesPrintInvoice');
    Route::get('SalesRepVisitsInvoice' ,[SalesTotalDailySalesReportController::class , 'SalesRepVisitsInvoice'])->name('SalesRepVisitsInvoice');
    Route::get('DSRInvoice' ,[SalesTotalDailySalesReportController::class , 'DSRInvoice'])->name('DSRInvoice');


