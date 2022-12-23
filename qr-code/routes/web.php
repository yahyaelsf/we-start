<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'check-type'])->name('admin.')->prefix('admin')->group(function (){

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/all-appointments', [DashboardController::class, 'AllAppointments']);
    Route::get('/appointment/{appointment}', [DashboardController::class, 'show']);

});

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/getVillaApi', [FrontController::class, 'getVillaApi']);
Route::post('/booking', [FrontController::class, 'booking']);


Route::get('uploadVideo', [VideoController::class, 'showUploadVideo']);
Route::post('uploadVideo', [VideoController::class, 'uploadVideo'])->name('videos.uploadVideo');


//certificates
Route::get('showCertificateForm', [CertificateController::class, 'showCertificateForm']);
Route::post('showCertificateForm', [CertificateController::class, 'submitCertificateForm'])->name('submitCertificateForm');
Route::get('/certificate/pdf/{id}', [CertificateController::class, 'createPDF'])->name('invoice.pdf');
Route::get('certificate/{id}', [CertificateController::class, 'show']);


//QrCode
Route::get('qr-code', [EventController::class, 'index']);
Route::post('qr-code', [EventController::class, 'store'])->name('qr-code');
