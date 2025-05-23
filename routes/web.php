<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::view('/', 'dashboard')->name('dashboard');

    Route::get('/invoices', App\Livewire\Invoices\Index::class)->name('invoices.index');
    Route::get('/invoice/new', App\Livewire\Invoices\Create::class)->name('invoices.create');

    Route::get('/contacts', App\Livewire\Contacts\Index::class)->name('contacts.index');
    Route::get('/contact/new', App\Livewire\Contacts\Create::class)->name('contacts.create');
    Route::get('/contact/edit/{contact}', App\Livewire\Contacts\Edit::class)->name('contacts.edit');

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::view('', 'settings')->name('index');
        Route::get('billing', App\Livewire\Settings\Billing::class)->name('billing');
        Route::get('accounts', App\Livewire\Settings\Accounts::class)->name('accounts');
    });

    Route::post('/logout', App\Http\Controllers\Auth\LogoutController::class)->name('logout');
});

Route::get('/locale/{locale}/switch', App\Http\Controllers\SwitchLocaleController::class)->name('locale.switch');
