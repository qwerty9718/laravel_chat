<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Work\ChatController;
use App\Http\Controllers\Work\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::group(['prefix' => 'chat'], function () {
        Route::get('/', [ChatController::class, 'index'])->name('chat.index');
        Route::post('/getChat', [ChatController::class, 'getChatRooms'])->name('chat.getChatRoom');
        Route::post('/createChatRoom', [ChatController::class, 'crateChatRoom'])->name('chat.createChat');
        Route::post('/sendMessage', [ChatController::class, 'sendMessage'])->name('chat.sendMessage');
        Route::post('/delNotify', [ChatController::class, 'deleteNotification'])->name('chat.delNotify');
        Route::get('/loadMoreMessages/{id}', [ChatController::class, 'loadMoreMessages'])->name('chat.loadMoreMessages');
        Route::patch('/updateUser', [UserController::class, 'updateUser'])->name('chat.updateUser');
        Route::post('/uploadImg', [UserController::class, 'uploadImg'])->name('chat.uploadImg');
        Route::get('/getUserImage/{id}', [UserController::class, 'getUserImage'])->name('chat.getUserImage');
    });

});

require __DIR__ . '/auth.php';
