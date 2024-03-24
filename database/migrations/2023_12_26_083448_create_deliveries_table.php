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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('from_first_line_address');
            $table->string('from_second_line_address');
            $table->string('from_state');
            $table->string('from_city');
            $table->string('from_postcode');
            $table->string('from_country');
            $table->decimal('from_latitude', 10, 8);
            $table->decimal('from_longitude', 11, 8);

            $table->string('to_first_line_address');
            $table->string('to_second_line_address');
            $table->string('to_state');
            $table->string('to_city');
            $table->string('to_postcode');
            $table->string('to_country');
            $table->decimal('to_latitude', 10, 8);
            $table->decimal('to_longitude', 11, 8);

            $table->foreignIdFor(\App\Models\Order::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\DeliveryPerson::class)->nullable();
            $table->string('status');
            $table->string('accepted_at')->nullable();
            $table->string('delivered_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
