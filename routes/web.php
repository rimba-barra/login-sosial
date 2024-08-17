<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('oauth/facebook', [\App\Http\Controllers\OauthController::class, 'redirectToProviderFacebook'])->name('oauth.facebook');
Route::get('oauth/facebook/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallbackFacebook'])->name('oauth.facebook.callback');

Route::get('oauth/google', [\App\Http\Controllers\OauthController::class, 'redirectToProviderGoogle'])->name('oauth.google');
Route::get('oauth/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallbackGoogle'])->name('oauth.google.callback');

Route::get('oauth/github', [\App\Http\Controllers\OauthController::class, 'redirectToProviderGithub'])->name('oauth.github');
Route::get('oauth/github/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallbackGithub'])->name('oauth.github.callback');
