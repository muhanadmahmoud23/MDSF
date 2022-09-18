<?php

use App\Http\Controllers\ExcelController;
use App\Http\Controllers\PrintInvoiceController;
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

//SalesPrintInvoice 
Route::get('SalesTerr' ,[PrintInvoiceController::class , 'SalesTerr'])->name('SalesTerr');
Route::get('SalesManTerr' ,[PrintInvoiceController::class , 'SalesManTerr'])->name('SalesManTerr');
Route::get('SalesPrintInvoice' ,[PrintInvoiceController::class , 'SalesPrintInvoice'])->name('SalesPrintInvoice');
Route::get('printInvoiceIndex', [PrintInvoiceController::class , 'printInvoiceIndex'])->name('printInvoiceIndex');

