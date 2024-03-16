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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('place_type_id');
            $table->string('name');
            $table->string('address');
            $table->string('latitude');
            $table->decimal('longitude');
            $table->decimal('BusinessStatus');
            $table->decimal('cost', 5, 2);
            $table->decimal('rating', 5, 2);
            $table->decimal('num_rating');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('place_type_id')->references('id')->on('place_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
