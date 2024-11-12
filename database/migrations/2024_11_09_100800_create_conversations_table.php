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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            // relation with the host uuid
            $table->string('host_id');
            $table->foreign('host_id')->references('id')->on('hosts')->onDelete('cascade');

            // relation with the guest uuid 
            $table->string('guest_id');
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');
           
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->boolean('is_open')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
        
    }
};
