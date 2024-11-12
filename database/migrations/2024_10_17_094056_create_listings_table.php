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
        Schema::create('listings', function (Blueprint $table) {
            $table->id(); 
            $table->string('title');
            $table->text('description'); 
            $table->decimal('price_per_night', 10, 2); 
            $table->integer('max_guest'); 
            $table->integer('bedrooms');
            $table->integer('bathrooms'); 
            $table->string('beds');
            $table->boolean('confirmed')->default(false); 
            $table->text('rules'); 
            $table->date('start_date');
            $table->date('end_date'); 
            $table->enum('status', ['active', 'inactive', 'soldout', 'comingsoon'])->default('comingsoon'); 
              // Foreign key for hosts - referencing UUID
              $table->uuid('host_id');  
              $table->foreign('host_id')->references('id')->on('hosts')->onDelete('cascade');

            $table->foreignId('location_id')->constrained()->onDelete('cascade'); 
            $table->timestamps(); 
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings'); // Drop the listings table
    }
};
