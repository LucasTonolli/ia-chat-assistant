<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsappController;
use App\Http\Middleware\TwilioRequestMiddleware;

Route::post('/new_message', [WhatsappController::class, 'new_message'])
    ->middleware(TwilioRequestMiddleware::class)
    ->name('new_message');
