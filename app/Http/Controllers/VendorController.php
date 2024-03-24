<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::all()->append('is_open');
        return inertia('Vendors/Index', [
            'vendors' => $vendors,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return inertia('Vendors/Show', [
            'vendor' => $vendor->load(['foodItems', 'reviews', 'reviews.user', 'reviews.likes', 'reviews.likes.user']),
        ]);
    }
}
