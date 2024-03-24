<?php

use App\Events\DeliveryAccepted;
use App\Events\Hello;
use App\Events\MyEvent;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Models\Delivery;
use App\Models\FoodItem;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Facades\Invoice;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function (Request $request) {
    $category = $request->query('category');
    $categories = [];
    foreach (FoodItem::CATEGORIES as $category) {
        $query = FoodItem::with(['likes', 'vendor', 'reviews'])
            ->withCount(['reviews'])
            ->withAvg('reviews', 'rating');
        $categories[$category] = $query->where('category', $category)->limit(20)->get();
    }


    return Inertia::render('Home', [
        'canLogin' => fn () => Route::has('login'),
        'canRegister' => fn () => Route::has('register'),
        'categories' => fn () => $categories,
        'discountedItems' => fn () => FoodItem::whereNotNull('old_price')->get(),
        'vendors' => fn () => \App\Models\Vendor::all(),
    ]);
})->name('home');


Route::get('/onboarding', function () {
    return inertia('Auth/Onboarding');
});

Route::resource('products', \App\Http\Controllers\FoodItemController::class);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/switch-role/{role}', function ($role) {
        $user = User::find(auth()->user()->id);
        if (
            $role == 'customer' && $user->isCustomer() ||
            $role == 'vendor' && $user->isVendor() ||
            $role == 'delivery-person' && $user->isDeliveryPerson()
        ) {
            $user->update([
                'role' => $role,
            ]);

            if ($role === 'customer') return redirect()->route('home');
            else if ($role === 'vendor') return redirect()->route('vendor.dashboard');
            else if ($role === 'delivery-person') return redirect()->route('delivery-person.dashboard');
        } else {
            return redirect()->back()->with([
                'flash.type' => 'flash',
                'flash.bannerStyle' => 'warning',
                'flash.banner' => 'You are not registered as a ' . ucfirst($role) . ' yet.',
                'flash.link' => 'Become a ' . $role . '',
                'flash.linkHref' => route('profile.show'),
            ]);
        }
        return redirect()->back();
    })->name('switch-role');
});
