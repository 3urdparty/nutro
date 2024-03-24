<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\FoodItem;
use App\Models\User;
use Illuminate\Http\Request;

class CartItemController extends Controller
{


    public function index()
    {
        $food_items = auth()->user()->customer->cart->foodItems->load(['reviews']);

        return inertia('CartItems/Index', [
            'items' => $food_items,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $cart = auth()->user()->customer->cart;
        $shopping_cart_item = $request->validate([
            'food_item_id' => 'required|exists:food_items,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $food_item = FoodItem::find($shopping_cart_item['food_item_id']);

        if ($cart->foodItems->contains($shopping_cart_item['food_item_id'])) {

            $quantity = $cart->foodItems()->where('food_item_id', $shopping_cart_item['food_item_id'])->first()->listing->quantity + $shopping_cart_item['quantity'];

            $cart->foodItems()->updateExistingPivot($shopping_cart_item['food_item_id'], ['quantity' => $quantity]);
            return redirect()->back()->with([
                'flash.bannerStyle' => 'success',
                'flash.banner' => 'Successfully updated Cart:',
                'flash.image_url' => $food_item->image_url,
                'flash.type' => 'activity',
                'flash.link' => 'View Shopping Cart',
                'flash.linkHref' => route('cartItems.index'),
                'flash.quantity' => $quantity,
                'flash.food_item' => $food_item->name,
            ]);;
        } else {

            $cart->foodItems()->save($food_item, ['quantity' => $shopping_cart_item['quantity']]);
            return redirect()->back()->with([
                'flash.bannerStyle' => 'success',
                'flash.banner' => 'Successfully added ' . $food_item->name . ' to cart!',
                'flash.image_url' => $food_item->image_url,
                'flash.type' => 'activity',
                'flash.link' => 'View Shopping Cart',
                'flash.linkHref' => route('cartItems.index'),
                'flash.quantity' => $shopping_cart_item['quantity'],
                'flash.food_item' => $food_item->name,
            ]);;
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back()->banner('Removed Item ' . $cartItem->foodItem->name . ' from cart sucessfully!');
    }
}
