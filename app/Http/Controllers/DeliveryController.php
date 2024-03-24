<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deliveries = Delivery::all();
        return inertia('Deliveries/Index', [
            'deliveries' => $deliveries,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Delivery $delivery)
    {
        $delivery->load('order.customer');
        return inertia('Deliveries/Show', [
            'delivery' => $delivery,
        ]);
    }



}
