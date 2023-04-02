<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoanController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');

    Route::get('/profile', 'userProfile');
    Route::post('/edit/profile', 'editUserProfile');
});

Route::get('/logout', function () {
    Auth::logout();
    return view('home');
});



Route::get('/newloan', function () {
    return view('newloan');
});


Route::controller(LoanController::class)->group(function () {
    Route::post('/newloan', 'newLoan');
    Route::get('/loan/history', 'loanHistory');
    Route::get('/loan/history/{id}', 'loanDetails');
});