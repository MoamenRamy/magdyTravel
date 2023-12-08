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
        Schema::create('user_travel', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('travel_id');
            $table->string('name');
            $table->integer('count')->default(1);
            $table->dateTime('bookDate');
            $table->string('userAddress');
            $table->string('phone');
            $table->string('whatsNumber');
            $table->decimal('price', 8, 2);
            $table->string('code')->default('USD');
            $table->timestamps();

            $table->foreign('travel_id')
            ->references('id')
            ->on('travel')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_travel');
    }
};
