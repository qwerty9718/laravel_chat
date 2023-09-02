<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestMessenger\MessageController;
use App\Http\Controllers\TestMessenger\PrototypeController;
use App\Http\Controllers\TestMessenger\UserController;
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


    Route::group(['prefix' => 'messages'], function (){
        Route::get('/',[MessageController::class,'index'])->name('message.index');
        Route::post('/',[MessageController::class,'store'])->name('message.store');
    });


    Route::group(["prefix" => "users"], function (){
        Route::get('/all',[UserController::class,'getAll'])->name('user.all');
        Route::post('/{id}',[UserController::class,'sendLike'])->name('user.sendLike');
        Route::post('/{id}/sendMessage',[UserController::class,'sendMessage'])->name('user.sendMessage');
    });

    Route::group(["prefix" => "chat-test"], function (){
        Route::get('/{id}',[PrototypeController::class,'myPage'])->name('chat.myPage');
        Route::get('/room/{id}',[PrototypeController::class,'myRoom'])->name('chat.myRoom');
        Route::post('/sendMessage',[PrototypeController::class,'sendMessage'])->name('chat.sendMessage');
    });


});

require __DIR__.'/auth.php';
