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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('weight');
            $table->integer('price');
            $table->string('link');
            $table->string('image');
            $table->boolean('is_paid');
            $table->
            $table->string('code',12)->autoIncrement();
            $table->integer('quantity');
            $table->enum('statuse',['arrived','panding','accpted','rejected','will arrive soon','in_progress' ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
