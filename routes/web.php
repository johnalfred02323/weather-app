<?php

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/', [LoginController::class, 'index'])->name('login');


// Route::get('/redirect_uri', function (Request $request) {
//     $code = "4TXEKRWQ4MOUM4JRPBZMYNCWHTBZXYE1PXVEZQ2OGCRGSYMZ";
//     dd($request->all());
// });
