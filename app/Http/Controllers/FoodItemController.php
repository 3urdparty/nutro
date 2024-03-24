<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $foodItems = FoodItem::with(['likes', 'vendor', 'reviews'])
            ->withCount(['reviews'])
            ->withAvg('reviews', 'rating')
            ->when($search, fn ($query, $search) => $query->where('name', 'like', '%' . $search . '%'))
            ->paginate(20);

        return inertia('FoodItems/Index', [
            'foodItems' => $foodItems,
            'vendors' => \App\Models\Vendor::all(),
            'canLogin' => fn () => Route::has('login'),
            'canRegister' => fn () => Route::has('register'),
        ]);
    }

    public function create(Request $request)
    {

        return inertia('FoodItems/Create', []);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            "id"=>"",
            "vendor_id" => ["required"],
            "name" => "required",
            "servings" => "required",
            "quantity" => "required",
            "unit" => "required",
            "protein" => "required",
            "carbohydrates" => "required",
            "calcium" => "required",
            "calories" => "required",
            "dietary_restriction" => "required",
            "category" => "required",
            "units" => "required",
            "price" => "required",
            "short_description" => "",
            "long_description" => "",
            "image_url" => "",
            "secondary_image_url" => "",
            "tertiary_image_url" => "",
            "quaternary_image_url" => "",
        ]);
        // dd($validated);


        $foodItem = FoodItem::updateOrCreate([
            'id'=>$validated['id'] ?? null,
        ],$validated);
        return redirect()->route('vendor.dashboard')->with([
            'flash.type' => 'flash',
            'flash.bannerStyle' => 'success',
            'flash.banner' => 'Added ' . $foodItem->name . ' to your inventory.',
            'flash.link' => 'View Now',
            'flash.linkHref' => route('products.show', $foodItem->slug),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {

        $item = FoodItem::with(['likes', 'vendor', 'reviews'])
            ->withCount(['reviews'])
            ->withAvg('reviews', 'rating')
            ->where('slug', $slug)
            ->firstOrFail();

        $reviews = $item->reviews()->with('customer')->paginate(5);
        $canBuy = auth()->check() && auth()->user()->role === 'customer';
        $canEdit = auth()->check() && auth()->user()->role === 'vendor' && auth()->user()->vendor->id === $item->vendor_id;

        return inertia('FoodItems/Show', [
            'item' => $item,
            'editable' => false,
            'canBuy' => $canBuy,
            'canEdit' => $canEdit,
            'canReview' => $canBuy,
            'reviews' => $reviews,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodItem $foodItem, string $slug)
    {
        $item = FoodItem::with(['likes', 'vendor', 'reviews'])
            ->withCount(['reviews'])
            ->withAvg('reviews', 'rating')
            ->where('slug', $slug)
            ->firstOrFail();

        return inertia('FoodItems/Create', [
            'item' => $item,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $fooditem = FoodItem::where('slug', $slug)->get()->first();
        $fooditem->delete();
        return redirect()->route('vendor.dashboard')->with([
            'flash.type' => 'flash',
            'flash.bannerStyle' => 'success',
            'flash.banner' => 'Successfully deleted FoodItem',
        ]);
    }
}
