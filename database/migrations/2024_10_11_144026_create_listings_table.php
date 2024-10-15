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
            $table->string('describtion');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->float('price_per_night');
            $table->integer('max_guest');
            $table->integer('no_bed');
            $table->integer('no_bath');
            $table->boolean('confirmed')->default(false);
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
