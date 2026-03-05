<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // Admin Routes
    Route::middleware([\App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
            Route::get('/events', \App\Livewire\Admin\EventsManager::class)->name('events');
            Route::get('/events/{event}/registrations', \App\Livewire\Admin\EventRegistrations::class)->name('events.registrations');
        }
        );

        // Student Routes
        Route::get('/events', \App\Livewire\Events\EventList::class)->name('events');    });

require __DIR__ . '/settings.php';
