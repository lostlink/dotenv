<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('free-trial-registration', [\App\Http\Controllers\RegisterByEmailOnly::class, 'store'])
    ->name('register.by_email_only');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('email/verify', fn () => view('auth.verify-email'))->name('verification.notice');

    Route::get('email/verify/{id}/{hash}', function (Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/dashboard');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('email/verification-notification', function (Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('project', \App\Http\Controllers\ProjectController::class)->only(['index', 'show']);
    Route::resource('project.target', \App\Http\Controllers\TargetController::class)->only(['show']);
//    Route::resource('project.target.environment', \App\Http\Controllers\EnvironmentController::class)->only(['show']);
});
