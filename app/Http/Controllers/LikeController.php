<?php

namespace App\Http\Controllers;

use App\Models\FoodItem;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,  FoodItem $product)
    {
        $product->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('home')->with([
            'flash.type'=>'flash',
            'flash.bannerStyle' => 'success',
            'flash.banner' => 'Liked successfully!',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodItem $product, Like $like)
    {

        Like::query()->where('user_id', auth()->id())->where('likeable_id', $product->id)->delete();


        return redirect()->route('home')->with([
            'flash.type'=>'flash',
            'flash.bannerStyle' => 'success',
            'flash.banner' => 'Unliked successfully!',
        ]);
    }

}
