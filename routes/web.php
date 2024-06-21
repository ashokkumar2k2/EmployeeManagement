<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\searchjobs;
use App\Http\Controllers\aboutus;
use App\Models\User;
use App\Models\addproducts;
use App\Models\jobs;
use Illuminate\Http\Request;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function (Request $request) {
    $jobs = jobs::all();
    $user_id =  $request->user()->id;
    return view('/dashboard', [
        'jobs' => $jobs, 'user_id' => $user_id

    ]);
    
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/addproduct', function () {

    return view('layouts/addproduct');
});

Route::post('addtowatchlist', [searchjobs::class, 'addtowatchlist']);
Route::get('/searchjob', [searchjobs::class, 'searchjob'])->middleware('auth');
Route::get('/aboutus', [aboutus::class, 'aboutus']);
Route::get('/contactus', [aboutus::class, 'contactus']);
Route::get('/watchlist', [searchjobs::class, 'watchlist']);


    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/watchlist', [searchjobs::class, 'viewwatchlist']);
    Route::post('/jobsapplied', [searchjobs::class, 'jobs_applied']);
    Route::get('/viewjobsapplied', [searchjobs::class, 'view_jobs_applied']);
    Route::post('/remove_watchlist_jobs', [searchjobs::class, 'remove_watchlist_jobs']);
    
});
Route::get('/addjobs', [searchjobs::class, 'Authaddjobs']);
Route::post('/phpmailer', [searchjobs::class, 'phpmailer']);
Route::get('/view_status', [searchjobs::class, 'view_status']);
require __DIR__ . '/auth.php';
