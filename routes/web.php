<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients', [ClientController::class, 'all'])->name('clients.all');
Route::post('/store', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
