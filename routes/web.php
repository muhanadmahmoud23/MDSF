<?php

use App\Http\Controllers\AndriodSupportController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HomeContoller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalesTotalDailySalesReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



Auth::routes();
//Home Controller
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
//Excel Uploads
Route::group(['middleware' => 'auth'], function () {
    Route::get('Excel', [ExcelController::class, 'Excel'])->name('Excel');
    Route::post('postProdGroup', [ExcelController::class, 'postProdGroup'])->name('postProdGroup');
    Route::post('postSalesTerr', [ExcelController::class, 'postSalesTerr'])->name('postSalesTerr');
    Route::post('postVan', [ExcelController::class, 'postVan'])->name('postVan');
    Route::post('postSalesMen', [ExcelController::class, 'postSalesMen'])->name('postSalesMen');
    Route::post('postSalesMenTerr', [ExcelController::class, 'postSalesMenTerr'])->name('postSalesMenTerr');
    Route::post('postJourney', [ExcelController::class, 'postJourney'])->name('postJourney');
    Route::post('postSalesCall', [ExcelController::class, 'postSalesCall'])->name('postSalesCall');
    Route::post('postSalesCallDetails', [ExcelController::class, 'postSalesCallDetails'])->name('postSalesCallDetails');
    Route::post('postPOS', [ExcelController::class, 'postPOS'])->name('postPOS');
    //SalesTotalDailySalesReportIndex
    Route::get('printInvoiceIndex', [SalesTotalDailySalesReportController::class, 'printInvoiceIndex'])->name('printInvoiceIndex');
    Route::get('SalesRepVisitsIndex', [SalesTotalDailySalesReportController::class, 'SalesRepVisitsIndex'])->name('SalesRepVisitsIndex');
    Route::get('DSRIndex', [SalesTotalDailySalesReportController::class, 'DSRIndex'])->name('DSRIndex');
    Route::get('POSIndex', [SalesTotalDailySalesReportController::class, 'POSIndex'])->name('POSIndex');
    Route::get('SalesRepIndex', [SalesTotalDailySalesReportController::class, 'SalesRepIndex'])->name('SalesRepIndex');
    Route::get('SaleTerrIndex', [SalesTotalDailySalesReportController::class, 'SaleTerrIndex'])->name('SaleTerrIndex');
    //SalesTotalDailySalesReportResults
    Route::get('SalesPrintInvoice', [SalesTotalDailySalesReportController::class, 'SalesPrintInvoice'])->name('SalesPrintInvoice');
    Route::get('SalesRepVisitsInvoice', [SalesTotalDailySalesReportController::class, 'SalesRepVisitsInvoice'])->name('SalesRepVisitsInvoice');
    Route::get('DSRInvoice', [SalesTotalDailySalesReportController::class, 'DSRInvoice'])->name('DSRInvoice');
    Route::get('POSInvoice', [SalesTotalDailySalesReportController::class, 'POSInvoice'])->name('POSInvoice');
    Route::get('SalesRepInvoice', [SalesTotalDailySalesReportController::class, 'SalesRepInvoice'])->name('SalesRepInvoice');
    Route::get('SaleTerrInvoice', [SalesTotalDailySalesReportController::class, 'SaleTerrInvoice'])->name('SaleTerrInvoice');
    //Common Ajax
    Route::get('SalesTerr', [SalesTotalDailySalesReportController::class, 'SalesTerr'])->name('SalesTerr');
    Route::get('SalesManTerr', [SalesTotalDailySalesReportController::class, 'SalesManTerr'])->name('SalesManTerr');
    Route::get('POSSalesManTerr', [SalesTotalDailySalesReportController::class, 'POSSalesManTerr'])->name('POSSalesManTerr');
    //Andriod Support
    Route::get('DevAndriodIndex', [AndriodSupportController::class, 'DevAndriodIndex'])->name('DevAndriodIndex');
    Route::get('DevAndriodInvoice', [AndriodSupportController::class, 'DevAndriodInvoice'])->name('DevAndriodInvoice');
    //Target
    Route::get('/file-import', [ExcelController::class, 'importView'])->name('import-view');
    Route::post('/import', [ExcelController::class, 'import'])->name('import');
    Route::get('/export-users', [ExcelController::class, 'exportUsers'])->name('export');
});
