<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionnaireController;

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/survei', [QuestionnaireController::class, 'create'])->name('survei.create');
Route::post('/survei', [QuestionnaireController::class, 'store'])->name('survei.store');