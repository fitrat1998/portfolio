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
        Schema::create('header_images', function (Blueprint $table) {
            $table->id(); // Ushbu jadvalda har bir page uchun alohida image saqlanadi
            $table->unsignedBigInteger('page_id');
            $table->string('header_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_images');
    }
};
