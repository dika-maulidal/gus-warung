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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // 1. Informasi Pelanggan (dari form checkout)
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
            $table->text('notes')->nullable();

            // 2. Pembayaran & Status
            $table->string('payment_method'); // cash, qris, transfer
            $table->bigInteger('subtotal');
            $table->bigInteger('ppn_amount');
            $table->bigInteger('shipping_fee');
            $table->bigInteger('total_amount');

            // Path untuk menyimpan bukti bayar
            $table->string('payment_proof_path')->nullable();

            // Status pesanan. Default 'Menunggu Pembayaran'
            $table->string('status')->default('Menunggu Pembayaran');

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
