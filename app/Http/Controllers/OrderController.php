<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceOrderRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $canPay = auth()->user()->role === 'customer';
        $orders = auth()->user()->customer->orders()->with(['items', 'items.reviews', 'items.vendor', 'payment', 'customer'])->get()->append('hash');
        return inertia('Orders/Index', [
            'orders' => $orders,
            'canPay' => $canPay,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Orders/Create', [
            'items' => auth()->user()->customer->cart->foodItems->load(['reviews', 'vendor']),
            'addresses' => auth()->user()->customer->addresses()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlaceOrderRequest $request)
    {
        $validated = $request->validated();
        $customer_address = Address::find($validated['address'])->only(['first_line_address', 'second_line_address', 'state', 'postcode', 'city', 'state', 'country']);
        $items = $validated['items'];
        $customer = auth()->user()->customer;
        $order =  Order::make(

            [
                'status' => 'placed',
            ]
        );


        $order =   $customer->orders()->save(
            $order
        );
        $order->items()->attach($items);
        $order->delivery()->create(
            [
                'to_first_line_address' => $customer_address['first_line_address'],
                'to_second_line_address' => $customer_address['second_line_address'],
                'to_state' => $customer_address['state'],
                'to_city' => $customer_address['city'],
                'to_postcode' => $customer_address['postcode'],
                'to_country' => $customer_address['country'],
                'from_first_line_address' => 'The Green Street 12',
                'from_second_line_address' => 'The Green Street 12',
                'from_state' => 'The Green Street 12',
                'from_city' => 'The Green Street 12',
                'from_postcode' => 'The Green Street 12',
                'from_country' => 'The Green Street 12',
                'status' => 'pending',
                'from_latitude' => 12.123,
                'from_longitude' => 12.123,
                'to_latitude' => 12.123,
                'to_longitude' => 12.123,
            ]
        );
        $customer->cart->foodItems()->detach($items);
        return redirect()->route('orders.show', $order->order_number)->with('success', 'Order placed successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $canPay = auth()->user()->role === 'customer';

        $order = $order->load(['items', 'items.reviews', 'items.vendor', 'customer.user', 'payment', 'delivery'])->append('hash');

        return inertia('Orders/Show', [
            'order' => $order,
            'canPay' => $canPay,
        ]);
    }


}
