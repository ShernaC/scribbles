<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/email/verify', [AuthController::class, 'showVerifyEmail'])->middleware('auth')->name('verification.notice'); // must be named like this
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'requestEmailVerification'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [AuthController::class, 'resendEmailVerificationRequest'])->middleware(['auth', 'throttle:6,1'])->name('verification.send'); // rate limit

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show.register');
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::get('/forgot-password', 'showForgotPassword')->name('password.request');
    Route::post('/forgot-password', 'sendResetPasswordEmail')->name('password.email');
    Route::get('/reset-password/sent', 'showSentResetEmail')->name('password.sent');
    Route::get('/reset-password/{token}', 'showResetPassword')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->name('password.update');
});

Route::middleware('auth')->controller(PostController::class)->group(function () {
    Route::get('/post/create', 'showCreate')->name('show.create');
    Route::get('/post/{id}/update', 'showUpdate')->name('show.update');
    Route::post('/post/create', 'createPost')->name('post.create');
    Route::put('/post/{id}/update', 'updatePost')->name('post.update');
    Route::delete('/post/{id}/delete', 'deletePost')->name('post.delete');
    Route::get('/post/all', 'getAllPosts')->name('post.all');
    Route::get('/post/{id}', 'getPost')->name('post.get');
    Route::get('/posts', 'getPostsByUserID')->name('post.getAll');
    Route::post('/post/uploadPicture', 'uploadPicture')->name('post.upload');
});

Route::get('/user', [UserController::class, 'userDetails'])->middleware('auth')->name("user");


