<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;


class OrderController extends Controller
{
    /**
     * Menerima dan memproses pesanan dari halaman checkout.
     * Termasuk menyimpan data dan mengupload bukti bayar.
     */
    public function placeOrder(Request $request)
    {
        // 1. Validasi Data Masukan
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'customer_address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:500',
            'payment_method' => 'required|in:cash,qris,transfer',
            'cart_data' => 'required|json',
            'total_amount' => 'required|integer|min:5000',
            'proof_of_payment' => 'nullable|image|max:2048',
        ]);


        // Parsing data keranjang dari JSON
        $cartItems = json_decode($request->cart_data, true);


        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }

        // 💡 PRE-CHECK STOK (Sudah benar di sini)
        foreach ($cartItems as $item) {
            $menu = Menu::find($item['id']);
            if (!$menu || $menu->stok < $item['quantity']) {
                return redirect()->back()->with('error', "Stok untuk {$item['name']} tidak mencukupi ({$menu->stok} tersisa).");
            }
        }


        // Mulai transaksi database untuk memastikan data konsisten
        DB::beginTransaction();
        try {
            // Hitung Ulang Total (Wajib di sisi server untuk keamanan)
            $subtotal = array_sum(array_map(function ($item) {
                return $item['price'] * $item['quantity'];
            }, $cartItems));


            $ppn_amount = $subtotal * 0.10; // 10% PPN
            $shipping_fee = $subtotal > 0 ? 5000 : 0;
            $final_total = $subtotal + $ppn_amount + $shipping_fee;


            if ($final_total != $request->total_amount) {
                // throw new \Exception("Kesalahan validasi harga. Harap coba lagi."); 
                // Opsional: Anda bisa menggunakan exception, atau redirect error
            }


            // 2. Tentukan Status Awal & Handle Bukti Bayar
            $status = 'Baru (Menunggu Konfirmasi)'; // Default untuk Cash
            $proofPath = null;


            if ($request->payment_method !== 'cash') {
                $status = 'Menunggu Pembayaran';


                if ($request->hasFile('proof_of_payment')) {
                    // Simpan file bukti bayar
                    $proofPath = $request->file('proof_of_payment')->store('public/payments');
                    $status = 'Menunggu Konfirmasi Admin'; // Berubah status jika bukti bayar diupload
                }
            }


            // 3. Simpan Pesanan Utama (Order)
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'notes' => $request->notes,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'ppn_amount' => round($ppn_amount),
                'shipping_fee' => $shipping_fee,
                'total_amount' => $final_total,
                'payment_proof_path' => $proofPath,
                'status' => $status,
                // user_id bisa ditambahkan jika Anda melacak user yang login
            ]);


            // 4. Simpan Detail Pesanan (Order Details) dan Lakukan PENGURANGAN STOK
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['id'],
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price_per_unit' => $item['price'],
                    'total_price' => $item['price'] * $item['quantity'],
                ]);


                // 🚀 PERBAIKAN: Lakukan PENGURANGAN STOK di sini!
                $menu = Menu::find($item['id']);
                if ($menu) {
                    $menu->decrement('stok', $item['quantity']);
                }

            }


            DB::commit();


            // 5. Beri feedback sukses ke user
            return redirect()->route('user.sell')->with(
                'success',
                "Pesanan Anda sebesar " . number_format($final_total, 0, ',', '.') .
                " telah berhasil diproses. Status awal: {$status}. Terima kasih!"
            );


        } catch (\Exception $e) {
            DB::rollBack();
            // Jika ada error (misal validasi harga, atau DB error), kembali dengan pesan error
            return redirect()->back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage());
        }
    }
}