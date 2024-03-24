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
        Schema::create('food_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(\App\Models\Vendor::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->integer('servings');
            $table->integer('quantity');
            $table->string('unit');
            $table->float('protein');
            $table->float('carbohydrates');
            $table->float('calcium');
            $table->float('calories');
            $table->string('dietary_restriction');
            $table->text('short_description');
            $table->longText('long_description');
            $table->string('category');
            $table->string('image_url')->nullable();
            $table->string('secondary_image_url')->nullable();
            $table->string('tertiary_image_url')->nullable();
            $table->string('quaternary_image_url')->nullable();
            $table->double('price');
            $table->integer('units')->default(0);
            $table->double('old_price')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food_items', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Vendor::class);
        });
        Schema::dropIfExists('food_items');
    }
};
