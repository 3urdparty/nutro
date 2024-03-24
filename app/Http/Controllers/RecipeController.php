<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = Recipe::all();
        return inertia('Recipes/Index', [
            'recipes' => $recipes,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return inertia('Recipes/Show', [
            'recipe' => $recipe,
        ]);
    }
}
