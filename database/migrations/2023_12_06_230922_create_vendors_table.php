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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('cover_image_url')->nullable();
            $table->string('logo_url')->nullable();
            $table->text('description')->nullable();
            $table->integer('open_time')->nullable();
            $table->integer('close_time')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('website_url')->nullable();
            $table->string('instagram_handle')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_handle')->nullable();
            $table->string('email')->nullable();
            $table->string('slug');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('vendors');
    }
};
