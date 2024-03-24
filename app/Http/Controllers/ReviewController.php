<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FoodItem $foodItem, string $slug)
    {
        $customer = User::find(auth()->id())->customer;
        $foodItem = FoodItem::where('slug', $slug)->first();
        $validated = $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $foodItem->reviews()->create([...$validated, 'customer_id' => $customer->id, 'reviewable_id' => $foodItem->id, 'reviewable_type' => FoodItem::class]);
        return redirect()->back()->with([
            'flash.type' => 'flash',
            'flash.bannerStyle' => 'success',
            'flash.banner' => 'Review submitted successfully',

        ]);
    }

}
