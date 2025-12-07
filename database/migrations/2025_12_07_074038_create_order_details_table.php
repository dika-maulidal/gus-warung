<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            // Foreign Key ke tabel orders
            $table->foreignId('order_id')->constrained()->onDelete('cascade');

            // Detail item yang dipesan
            $table->foreignId('menu_id')->nullable(); // Jika ingin melacak menu asli
            $table->string('product_name');
            $table->integer('quantity');
            $table->bigInteger('price_per_unit');
            $table->bigInteger('total_price');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
