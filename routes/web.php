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
Route::get('/career/{slug}', [MainController::class, 'showCareer'])->name('maincontroller.showCareer');
Route::post('/career/load-more', [MainController::class, 'loadMoreJobs'])->name('career.loadMore');
Route::post('/career/apply-job', [MainController::class, 'applyCareer'])->name('career.apply');
Route::get('/news', [MainController::class, 'news']);
Route::get('/news/{slug}', [MainController::class, 'showNews'])->name('maincontroller.showNews');
Route::get('/gallery', [MainController::class, 'gallery']);
Route::get('/contact', [MainController::class, 'contact']);
Route::post('/contact/send', [MainController::class, 'sendContact'])->name('contact.send');

Route::get('/lang/{lang}', function ($lang) {
    session(['locale' => $lang]);
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
