<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\NewsController;
use App\Http\Controllers\front\NewsCategoryController;

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news-categories', [NewsCategoryController::class, 'index']);