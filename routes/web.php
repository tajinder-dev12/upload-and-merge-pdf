<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PdfController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PdfController::class, "index"]);
Route::get('pdf-files', [PdfController::class, "index"]);
Route::get('add-files', [PdfController::class, "create"]);
Route::post('store-files', [PdfController::class, "store"]);
Route::get('download-pdf/{id}', [PdfController::class, "downloadPdf"]);
Route::post('download-multiple-pdf', [PdfController::class, "downloadMultiplePdf"]);



