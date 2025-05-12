<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index']);
Route::get('/about-us', [MainController::class, 'about']);
Route::get('/career', [MainController::class, 'career']);

Route::get('/lang/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return redirect()->back();
});

Route::get('/template/category-download', function () {
    return response()->download(public_path('import-templates/category-import-template.xlsx'));
})->name('template.category.download');

Route::get('/template/principal-download', function () {
    return response()->download(public_path('import-templates/principal-import-template.xlsx'));
})->name('template.principal.download');

Route::get('/template/certificate-download', function () {
    return response()->download(public_path('import-templates/certificate-import-template.xlsx'));
})->name('template.certificate.download');
