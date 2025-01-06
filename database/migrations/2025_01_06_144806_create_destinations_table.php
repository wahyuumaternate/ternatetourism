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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama destinasi
            $table->string('image'); // Nama destinasi
            $table->text('description')->nullable(); // Deskripsi destinasi
            $table->string('lat'); // Latitude dengan presisi tinggi
            $table->string('long'); // Longitude dengan presisi tinggi
            $table->string('slug')->unique(); // Slug unik untuk SEO
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
