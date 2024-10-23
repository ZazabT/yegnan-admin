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
        Schema::create('hosts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->longText('hostDescription');  
            $table->string('profilePicture')->nullable(); 
            $table->string('username');
            $table->string('country');
            $table->string('region');
            $table->string('city');
            $table->string('phone_number');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('telegram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('frontIdImage');
            $table->string('backIdImage');
            $table->decimal('rating', 3, 2)->nullable();
            $table->boolean('isVerified')->default(false);
            $table->timestamps();
            
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hosts');
    }
};
