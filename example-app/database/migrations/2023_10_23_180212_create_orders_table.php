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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('description');
            $table->integer('price')->default(0);
            $table->integer('wieght')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->enum('role',[
                'pandding',
                'not-accepted',
                'accepted',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
