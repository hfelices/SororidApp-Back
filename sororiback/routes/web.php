<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstructionController;

Route::get('/', [InstructionController::class, 'showInstructions'])->name('instructions');
Route::get('/download/{filename}', [InstructionController::class, 'downloadFile'])->name('download');

require __DIR__.'/auth.php';
