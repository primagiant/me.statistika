<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\StatistikController;
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

Route::get('/', function () {
    $skor = App\Models\Data::count();
    $moment = App\Models\Moment::count();
    $ujit = App\Models\UjiT::count();
    $anava = App\Models\UjiAnava::count();
    return view('dashboard', [
        'skor' => $skor,
        'moment' => $moment,
        'ujit' => $ujit,
        'anava' => $anava,
    ]);
})->name('dashboard');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::prefix('datalist')->group(function () {
    Route::get('skor', [DataController::class, 'skor'])->name('datalist.skor');
    Route::get('moment', [DataController::class, 'moment'])->name('datalist.moment');
    Route::get('ujit', [DataController::class, 'ujit'])->name('datalist.ujit');
    Route::get('anava', [DataController::class, 'anava'])->name('datalist.anava');
});

Route::prefix('statistika')->group(function () {
    Route::get('frequensi', [StatistikController::class, 'frequensi'])->name('statistika.frequensi');
    Route::get('bergolong', [StatistikController::class, 'bergolong'])->name('statistika.bergolong');
    Route::get('chi', [StatistikController::class, 'chi'])->name('statistika.chi');
    Route::get('lilliefors', [StatistikController::class, 'lilliefors'])->name('statistika.lilliefors');
    Route::get('moment', [StatistikController::class, 'moment'])->name('statistika.moment');
    Route::get('ujit', [StatistikController::class, 'ujit'])->name('statistika.ujit');
    Route::get('anava', [StatistikController::class, 'anava'])->name('statistika.anava');
});

Route::prefix('options')->group(function () {
    Route::get('export', [OptionsController::class, 'export'])->name('options.export');
    Route::get('import', [OptionsController::class, 'import'])->name('options.import');
});
