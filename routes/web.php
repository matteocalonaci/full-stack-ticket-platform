<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;

use Illuminate\Support\Facades\Auth;

// ...

Route::get('/', function () {
    return view('welcome');
});

// Disabilita la registrazione prima di includere auth.php
Auth::routes(['register' => false]); // Disabilita la registrazione
Route::get('/register', function () {
    return redirect('/'); // Reindirizza alla home
});

//Istallo composer require laravel/ui
// è un comando che installa il pacchetto laravel/uinel tuo progetto Laravel.
// fornisce un modo per personalizzare l'impalcatura di autenticazione, inclusa la possibilità di nascondere il register percorso.



Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


    });

// Includi auth.php dopo aver disabilitato la registrazione
require __DIR__ . '/auth.php';
