<?php

namespace App\Providers;

use App\Events\DeliveryAccepted;
use App\Http\Controllers\DeliveryController;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('deliveries', DeliveryController::class);
Route::get('/dashboard', function () {
    $my_deliveries =  Delivery::with(['order', 'order.items' => fn ($q) => $q->select('image_url'), 'order.customer.user'])->where('delivery_person_id', auth()->user()->id)->get();
    $deliveries = Delivery::with(['order', 'order.items', 'order.customer.user'])
        ->where('delivery_person_id', null)
        ->paginate(2);

    $completed_current = $my_deliveries->where('status', 'completed')->whereBetween('delivered_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
    $completed_previous = $my_deliveries->where('status', 'completed')->whereBetween('delivered_at', [now()->startOfMonth()->previous('month'), now()->startOfMonth()])->count();
    $money_earned_current = $my_deliveries->where('status', 'completed')->whereBetween('delivered_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('delivery_fee');
    $money_earned_previous = $my_deliveries->where('status', 'completed')->whereBetween('delivered_at', [now()->startOfMonth()->previous('month'), now()->startOfMonth()])->sum('delivery_fee');
    return inertia('DeliveryDashboard', [
        'deliveries' => $deliveries,
        'my_deliveries' => $my_deliveries,
        'completed' => [
            'current' => $completed_current,
            'previous' => $completed_previous
        ],
        'money_earned' => [
            'current' => $money_earned_current,
            'previous' => $money_earned_previous
        ],
    ]);
})->name('delivery-person.dashboard');
Route::get('/deliveries/{delivery}/accept', function (Request $request, Delivery $delivery) {
    $delivery_person = auth()->user()->deliveryPerson;

    if ($delivery_person->inProgressDeliveries()->count() <= 0) {
        $delivery->update([
            'delivery_person_id' => auth()->user()->id,
            'status' => 'in_progress',
            'accepted_at' => now(),
        ]);
        broadcast(new DeliveryAccepted($delivery->id, $delivery->id));
    } else if ($delivery_person->pendingDeliveries()->count() < 3) {
        $delivery->update([
            'delivery_person_id' => auth()->user()->id,
            'status' => 'pending',
            'accepted_at' => now(),
        ]);
        broadcast(new DeliveryAccepted($delivery->id, $delivery->id));
    }
})->name('deliveries.accept');


Route::get('/deliveries/{delivery}/complete', function (Request $request, Delivery $delivery) {
    $delivery_person = auth()->user()->deliveryPerson;
    if ($delivery->delivery_person_id == auth()->user()->id) {
        if ($delivery->status == 'in_progress') {
            $delivery->update([
                'status' => 'completed',
                'delivered_at' => now(),
            ]);

            $delivery_person->pendingDeliveries()->first()->update([
                'status' => 'in_progress',
            ]);
        }

        return redirect()->route('delivery-person.dashboard');
    }
})->name('deliveries.complete');
Route::get('/deliveries/{delivery}/start', function (Request $request, Delivery $delivery) {
    $delivery_person = auth()->user()->deliveryPerson;

    if ($delivery->delivery_person_id == auth()->user()->id) {
        if ($delivery->status == 'pending') {
            $delivery->update([
                'status' => 'in_progress',
            ]);
        }

        return redirect()->route('deliveries.show', $delivery->id);
    }
})->name('deliveries.start');
