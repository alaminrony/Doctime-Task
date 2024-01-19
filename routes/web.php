<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BulkUploadController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('upload',            [BulkUploadController::class, 'view'])->name('bulk.upload.view');
Route::post('upload',           [BulkUploadController::class, 'upload'])->name('bulk.upload.store');
Route::get('batch/{id}',        [BulkUploadController::class, 'batch'])->name('bulk.upload.progress-bar');

Route::get('users',             [UserController::class, 'index'])->name('users');
