<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::view('/', 'landing')->name('landing');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', App\Http\Controllers\DashboardController::class)->name('dashboard');

    Route::get('/invoices', App\Livewire\Invoices\Index::class)->name('invoices.index');
    Route::get('/invoice/new', App\Livewire\Invoices\Create::class)->name('invoices.create')->middleware(App\Http\Middleware\EnsureUserHasFilledBillingSettings::class);
    Route::get('/invoice/edit/{invoice}', App\Livewire\Invoices\Edit::class)->name('invoices.edit');
    Route::get('/invoice/{invoice}', App\Livewire\Invoices\Show::class)->name('invoices.show');
    Route::get('/invoice/pdf/{invoice}', [App\Http\Controllers\InvoiceController::class, 'print'])->name('invoices.print')->middleware(App\Http\Middleware\EnsureUserHasFilledBillingSettings::class);
    Route::get('/invoice/download/{invoice}', [App\Http\Controllers\InvoiceController::class, 'download'])->name('invoices.download')->middleware(App\Http\Middleware\EnsureUserHasFilledBillingSettings::class);

    Route::get('/contacts', App\Livewire\Contacts\Index::class)->name('contacts.index');
    Route::get('/contact/new', App\Livewire\Contacts\Create::class)->name('contacts.create');
    Route::get('/contact/edit/{contact}', App\Livewire\Contacts\Edit::class)->name('contacts.edit');

    Route::get('/folders', App\Livewire\Folders\Index::class)->name('folders.index');
    Route::get('/folder/edit/{folder}', App\Livewire\Folders\Edit::class)->name('folders.edit');

    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function () {
        Route::view('', 'settings')->name('index');
        Route::get('billing', App\Livewire\Settings\Billing::class)->name('billing');
        Route::get('accounts', App\Livewire\Settings\Accounts::class)->name('accounts');
        Route::get('user/details', App\Livewire\Settings\User\Details::class)->name('user.details');
        Route::get('user/password', App\Livewire\Settings\User\Password::class)->name('user.password');
    });

    Route::post('/logout', App\Http\Controllers\Auth\LogoutController::class)->name('logout');
});

Route::get('/locale/{locale}/switch', App\Http\Controllers\SwitchLocaleController::class)->name('locale.switch');
