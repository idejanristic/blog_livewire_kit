<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Backend\Auth\ConfirmPassword;
use App\Livewire\Backend\Auth\ForgotPassword;
use App\Livewire\Backend\Auth\Login;
use App\Livewire\Backend\Auth\Register;
use App\Livewire\Backend\Auth\ResetPassword;
use App\Livewire\Backend\Auth\VerifyEmail;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
    Route::get('forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', VerifyEmail::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::get('confirm-password', ConfirmPassword::class)
        ->name('password.confirm');
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
