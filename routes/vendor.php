<?php

namespace App\Providers;



use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    $vendor = auth()->user()->vendor;
    $foodItems = $vendor->foodItems()
        ->with(['likes', 'reviews'])
        ->withCount(['reviews'])
        ->withAvg('reviews', 'rating')
        ->paginate(9);

    $orders = $vendor
        ->orders()
        ->with(['items'])
        ->with(['customer'])
        ->paginate(3);
    return inertia('VendorDashboard', [
        'foodItems' => $foodItems,
        'orders' => $orders,
    ]);
})->name('vendor.dashboard');
