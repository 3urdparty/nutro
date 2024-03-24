<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

use function Pest\Laravel\post;

class PaymentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Order::find($request->get('order_id'));
        $order->status = 'placed';
        $order->save();

        Payment::create([
            'order_id' => $order->id,
            'amount' => $order->subtotal,
            'status' => 'paid',
        ]);

        return to_route('orders.index')->with([
            'flash.type' => 'flash',
            'flash.bannerStyle' => 'success',
            'flash.banner' => 'Successfully paid for Order.',
            'flash.link' => 'Check on delivery updates',
            'flash.linkHref' => route('orders.show', ['order' => $request->get('order_id')]),
        ]);
    }

}
