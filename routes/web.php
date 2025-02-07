<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\NewsController;
use App\Http\Controllers\front\NewsCategoryController;
use App\Http\Controllers\admin\NewsController as AdminNews;
use App\Http\Controllers\admin\NewsCategoryController as AdminNewsCategory;
use App\Http\Controllers\admin\DashboardController;



Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/xəbər-kategoriyaları', [NewsCategoryController::class,'index'])->name('news-category');
Route::get('/xəbərlər', [NewsController::class,'index'])->name('news');
Route::get('/xəbər/{id}', [NewsController::class,'detail'])->name('news-detail');


Route::get('admin' ,function (){
    return redirect()->route('news.index');
});

Route::prefix('admin')->group(function () {
    Route::resource('news',AdminNews::class);
    Route::resource('news-category',AdminNewsCategory::class);
    Route::resource('dashboard',DashboardController::class);
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     // Route::get('/disk',[DiskController::class,'index'])->name('disk');

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



require __DIR__.'/auth.php';
