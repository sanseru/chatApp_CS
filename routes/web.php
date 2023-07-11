<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sidebar', function () {
    return view('sidebar');
})->middleware(['auth', 'verified'])->name('sidebar');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('chat', ChatController::class);
    Route::prefix('chat')->controller(ChatController::class)->group(function () {
        Route::get('show/all', 'chat')->name('chats');
        Route::get('showchats/all', 'chat_email')->name('chats_email');
        Route::get('unread/all', 'unRead')->name('chatunread');
        Route::post('uploadfile', 'uploadFileChat')->name('uploadfilechat');
        // Route::get('file/read', 'fileRead')->name('fileread');

    });

});

require __DIR__.'/auth.php';
