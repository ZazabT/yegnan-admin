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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

           // relation with the guest uuid 
            $table->string('guest_id');
            $table->foreign('guest_id')->references('id')->on('guests')->onDelete('cascade');

            $table->foreignId('listing_id')->constrained()->onDelete('cascade');
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'accepted', 'rejected' , 'completed'])->default('pending');
            $table->integer('guest_count');
            $table->enum('payment_status', ['pending', 'paid'])->default('pending');
            $table->boolean('hasMessage')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
        
    }
    
};
