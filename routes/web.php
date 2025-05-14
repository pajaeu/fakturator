<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::view('/', 'dashboard')->name('dashboard');

    Route::get('/contact/new', App\Livewire\Contacts\Create::class)->name('contacts.create');
});
