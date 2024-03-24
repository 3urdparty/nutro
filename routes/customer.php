<?php

namespace App\Providers;

use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Models\Order;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use Illuminate\Support\Facades\Route;
use LaravelDaily\Invoices\Invoice;

Route::resource('recipes', \App\Http\Controllers\RecipeController::class);

Route::resource('cart', CartItemController::class)->names([
    'index' => 'cartItems.index',
    'store' => 'cartItem.store',
    'destroy' => 'cartItem.destroy',
    'update' => 'cartItem.update',
])->parameter('cart', 'cartItem');

Route::resource('orders', OrderController::class);

Route::resource('orders.payments', PaymentController::class)
    ->only(['create', 'store'])
    ->scoped();
Route::resource('customer', CustomerController::class)->only(['store', 'update']);
Route::resource('vendors', \App\Http\Controllers\VendorController::class);
Route::resource('recipes', \App\Http\Controllers\RecipeController::class);
Route::resource('deals', \App\Http\Controllers\DealController::class);

Route::resource('products.reviews', ReviewController::class)->scoped();
Route::resource('products.likes', LikeController::class)->scoped();


Route::get('verify-payment', [PaymentController::class, 'store'])->name('payment.verify');

Route::get('/orders/{order}/invoice', function (Order $order) {
    $vendor =
        $client = new Party([
            'name'          => 'Nutro Sdn Bhd',
            'phone'         => '+60 11 230 49307',
            'custom_fields' => [
                'note'        => 'IDDQD',
                'business id' => '365#GG',
            ],
        ]);


    $customer = new Party([
        'name'          => auth()->user()->name,
        'address'       => 'The Green Street 12',
        'code'          => '#22663214',
        'custom_fields' => [
            'order number' => '> ' . $order->order_number . ' <',
        ],
    ]);

    $order_items = $order->items->map(function ($item) {
        return InvoiceItem::make($item->name)
            ->pricePerUnit($item->price)
            ->quantity($item->listing->quantity)
            ->description($item->short_description)
            ->units($item->unit)
            ->subTotalPrice($item->price * $item->listing->quantity)
            ->discountByPercent(0)
            ->taxByPercent(0);
    });

    $notes = [
        'Solstice@Pan\'gaea,',
        '32nd Floor, Tower 2, Appartment no. 32',
        'Cyberjaya, Selangor, Malaysia',
    ];
    $notes = implode("<br>", $notes);

    $invoice = Invoice::make('receipt')
        ->series('ORDER')
        ->status(__('invoices::invoice.paid'))
        ->sequence($order->id)
        ->serialNumberFormat('{SEQUENCE}/{SERIES}')
        ->seller($client)
        ->buyer($customer)
        ->date(now())
        ->dateFormat('d/m/Y')
        ->currencySymbol('RM')
        ->currencyCode('MYR')
        ->currencyFormat('{SYMBOL}{VALUE}')
        ->currencyThousandsSeparator(',')
        ->currencyDecimalPoint('.')
        ->filename($order->name . ' Invoice')
        ->addItems($order_items)
        ->notes($notes)
        ->logo(public_path("/images/logo.png"));
    // You can additionally save generated invoice to configured disk


    $link = $invoice->url();

    // And return invoice itself to browser or have a different view
    return $invoice->stream();
    // return $invoice->download();
})->name('orders.invoice');
