<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestMessenger\MessageController;
use App\Http\Controllers\TestMessenger\PrototypeController;
use App\Http\Controllers\TestMessenger\UserController;
use App\Http\Controllers\Work\ChatController;
use App\Http\Controllers\Work\MainController;
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


    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', [MessageController::class, 'index'])->name('message.index');
        Route::post('/', [MessageController::class, 'store'])->name('message.store');
    });


    Route::group(["prefix" => "users"], function () {
        Route::get('/all', [UserController::class, 'getAll'])->name('user.all');
        Route::post('/{id}', [UserController::class, 'sendLike'])->name('user.sendLike');
        Route::post('/{id}/sendMessage', [UserController::class, 'sendMessage'])->name('user.sendMessage');
    });

    Route::group(["prefix" => "chat-test"], function () {
        Route::get('/', [PrototypeController::class, 'myPage'])->name('chat-test.myPage');
        Route::get('/room/{id}', [PrototypeController::class, 'myRoom'])->name('chat-test.myRoom');
        Route::post('/sendMessage', [PrototypeController::class, 'sendMessage'])->name('chat-test.sendMessage');
        Route::patch('/chat-room/{id}', [PrototypeController::class, 'setStatusToChatRoom'])->name('chat-test.up-chat-status');
    });


    Route::group(['prefix' => 'chat-prototype'], function () {
        Route::get('/', [MainController::class, 'index'])->name('chat-prototype.index');
        Route::post('/getChat', [MainController::class, 'getChatRooms'])->name('chat-prototype.getChatRoom');
        Route::post('/createChatRoom', [MainController::class, 'crateChatRoom'])->name('chat-prototype.createChat');
        Route::post('/updateSecondUserChatStatus', [MainController::class, 'updateSecondUserChatStatus'])->name('chat-prototype.updateSecondUserChatStatus');
    });

    Route::group(['prefix' => 'chat'], function () {
        Route::get('/', [ChatController::class, 'index'])->name('chat.index');
        Route::post('/getChat', [ChatController::class, 'getChatRooms'])->name('chat.getChatRoom');
        Route::post('/createChatRoom', [ChatController::class, 'crateChatRoom'])->name('chat.createChat');
        Route::post('/updateSecondUserChatStatus', [ChatController::class, 'updateSecondUserChatStatus'])->name('chat.updateSecondUserChatStatus');
    });

});

require __DIR__ . '/auth.php';
