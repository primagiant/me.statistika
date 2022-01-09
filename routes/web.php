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
    Route::prefix('skor')->group(function () {
        Route::get('/', [DataController::class, 'skor'])->name('datalist.skor');
        Route::post('/add', [DataController::class, 'skorTambah'])->name('datalist.skor.add');
        Route::put('/edit/{id}', [DataController::class, 'skorEdit'])->name('datalist.skor.edit');
        Route::delete('/delete/{id}', [DataController::class, 'skorDelete'])->name('datalist.skor.delete');
    });
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

Route::prefix('export')->group(function () {
    Route::post('skor', [OptionsController::class, 'exportSkor'])->name('export.skor');
    Route::post('moment', [OptionsController::class, 'exportMoment'])->name('export.moment');
    Route::post('ujit', [OptionsController::class, 'exportUjiT'])->name('export.ujit');
    Route::post('anava', [OptionsController::class, 'exportUjiAnava'])->name('export.anava');
});

Route::prefix('import')->group(function () {
    Route::post('skor', [OptionsController::class, 'importSkor'])->name('import.skor');
    Route::post('moment', [OptionsController::class, 'importMoment'])->name('import.moment');
    Route::post('ujit', [OptionsController::class, 'importUjiT'])->name('import.ujit');
    Route::post('anava', [OptionsController::class, 'importUjiAnava'])->name('import.anava');
});

Route::prefix('truncate')->group(function () {
    Route::post('skor', [OptionsController::class, 'truncateSkor'])->name('truncate.skor');
    Route::post('moment', [OptionsController::class, 'truncateMoment'])->name('truncate.moment');
    Route::post('ujit', [OptionsController::class, 'truncateUjiT'])->name('truncate.ujit');
    Route::post('anava', [OptionsController::class, 'truncateUjiAnava'])->name('truncate.anava');
});
