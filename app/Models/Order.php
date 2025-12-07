<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Sesuaikan fillable dengan kolom di tabel orders Anda
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_address',
        'notes',
        'payment_method',
        'subtotal',
        'ppn_amount',
        'shipping_fee',
        'total_amount',
        'payment_proof_path',
        'status',
        'user_id' // Tambahkan user_id jika ada
    ];

    /**
     * Relasi ke OrderDetail (satu order memiliki banyak detail)
     */
    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}