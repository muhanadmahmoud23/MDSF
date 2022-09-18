<?php

use App\Http\Controllers\ScInvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('invoice', ScInvoiceController::class);
Route::get('pivotInvoice' ,[ScInvoiceController::class , 'pivotInvoice']);
Route::get('pivotInvoicee' ,[ScInvoiceController::class , 'pivotInvoicee']);