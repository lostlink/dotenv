<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('free-trial-registration', [App\Http\Controllers\RegisterByEmailOnly::class, 'store'])
    ->name('register.by_email_only');

Route::middleware('auth:sanctum')->group(function () {
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

Route::middleware('auth:sanctum', 'verified')->group(function () {
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::name('project.')->group(function () {
        Route::get('project', [App\Http\Controllers\ProjectController::class, 'index'])->name('index');
        Route::get('project/{project:slug}', [App\Http\Controllers\ProjectController::class, 'show'])->name('show');
    });

    Route::get('project/{project:slug}/target/{target:slug}', [App\Http\Controllers\TargetController::class, 'show'])
        ->name('project.target.show')
        ->scopeBindings();
});

Route::mediaLibrary();
