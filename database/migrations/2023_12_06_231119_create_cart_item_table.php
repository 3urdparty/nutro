<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(\App\Models\Cart::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\FoodItem::class)->constrained()->cascadeOnDelete();
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Cart::class);
            $table->dropForeignIdFor(\App\Models\FoodItem::class);
        });
        Schema::dropIfExists('cart_items');
    }
};
