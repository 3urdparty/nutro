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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_line_address');
            $table->string('second_line_address');
            $table->string('state');
            $table->string('city');
            $table->string('postcode');
            $table->string('country');
            $table->boolean('is_default')->default(false);
            $table->string('name');
            $table->foreignIdFor(\App\Models\Customer::class)->constrained()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Customer::class);
        });
        Schema::dropIfExists('addresses');
    }
};
