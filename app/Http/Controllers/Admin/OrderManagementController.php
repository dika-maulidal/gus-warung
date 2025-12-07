<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order; // Pastikan Anda memiliki model ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class OrderManagementController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        // Ambil semua pesanan terbaru, urutkan dari yang terbaru (descending)
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        // Kirim data orders ke view
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail spesifik dari satu pesanan.
     */
    public function show(Order $order)
    {
        // Memuat detail item pesanan (order_details)
        // Pastikan relasi 'details' sudah didefinisikan di model Order
        $order->load('details');

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Mengubah status pesanan.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Pembayaran,Menunggu Konfirmasi Admin,Diproses,Lunas,Dibatalkan',
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        DB::beginTransaction();
        try {
            // ✨ 1. LOGIC PENGEMBALIAN STOK (jika status diubah menjadi DIBATALKAN)
            // Hanya jalankan jika status LAMA BUKAN Dibatalkan dan status BARU adalah Dibatalkan.
            if ($oldStatus != 'Dibatalkan' && $newStatus == 'Dibatalkan') {
                $order->load('details');
                foreach ($order->details as $item) {
                    $menu = Menu::lockForUpdate()->find($item->menu_id);
                    if ($menu) {
                        $menu->increment('stok', $item->quantity);
                    }
                }
            }

            // ✨ 2. LOGIC PENGURANGAN STOK (Opsional, jika Anda belum menguranginya di placeOrder)
            // Ini diperlukan jika Anda ingin mengurangi stok HANYA saat admin menekan "Diproses" atau "Lunas"
            /*
            if ($oldStatus != 'Diproses' && $oldStatus != 'Lunas' && ($newStatus == 'Diproses' || $newStatus == 'Lunas')) {
                // Logika ini akan SAMA PERSIS dengan yang ada di OrderController. 
                // Karena kita sudah menguranginya di OrderController, Anda bisa MENGABAIKAN bagian ini.
            }
            */

            // 3. Simpan status baru
            $order->status = $newStatus;
            $order->save();

            DB::commit();

            return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . $newStatus . '.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengubah status: ' . $e->getMessage());
        }
    }
}