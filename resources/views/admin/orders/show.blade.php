<!DOCTYPE html>
<html lang="id">

<head>
    <title>Detail Pesanan #{{ $order->id }} - Admin GusWarung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container my-5">
        <h1 class="mb-4 text-warning">Detail Pesanan #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary mb-3"><i
                class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Pesanan</a>
        <hr>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            {{-- KOLOM KIRI: Detail Pesanan --}}
            <div class="col-lg-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-warning text-white fw-bold">Detail Pelanggan & Status</div>
                    <div class="card-body">
                        <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Telepon:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Alamat:</strong> {{ $order->customer_address ?? '-' }}</p>
                        <p><strong>Catatan:</strong> {{ $order->notes ?? '-' }}</p>
                        <p class="mt-3"><strong>Waktu Pesan:</strong>
                            {{ $order->created_at->translatedFormat('d F Y, H:i') }}</p>

                        <h5 class="mt-4 fw-bold">Update Status Pesanan</h5>

                        {{-- Formulir untuk Mengubah Status --}}
                        <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST"
                            class="d-flex gap-2">
                            @csrf
                            @method('PUT')

                            <select name="status" class="form-select w-75">
                                <option value="Menunggu Pembayaran" {{ $order->status == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                                <option value="Menunggu Konfirmasi Admin" {{ $order->status == 'Menunggu Konfirmasi Admin' ? 'selected' : '' }}>Menunggu Konfirmasi Admin</option>
                                <option value="Diproses" {{ $order->status == 'Diproses' ? 'selected' : '' }}>Diproses
                                </option>
                                <option value="Lunas" {{ $order->status == 'Lunas' ? 'selected' : '' }}>Lunas (Tandai
                                    Lunas)</option>
                                <option value="Dibatalkan" {{ $order->status == 'Dibatalkan' ? 'selected' : '' }}>
                                    Dibatalkan</option>
                            </select>

                            <button type="submit" class="btn btn-warning w-25">Update</button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold">Item Pesanan</div>
                    <ul class="list-group list-group-flush">
                        @foreach ($order->details as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->product_name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $item->quantity }} x Rp
                                        {{ number_format($item->price_per_unit, 0, ',', '.') }}</small>
                                </div>
                                <span class="fw-bold">Rp {{ number_format($item->total_price, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- KOLOM KANAN: Ringkasan & Bukti Bayar --}}
            <div class="col-lg-5">
                <div class="card bg-white shadow-sm p-4">
                    <h5 class="fw-bold mb-3 text-center text-warning">Ringkasan Pembayaran</h5>

                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Ongkir</span>
                        <span>Rp {{ number_format($order->shipping_fee, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>PPN (10%)</span>
                        <span>Rp {{ number_format($order->ppn_amount, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>TOTAL AKHIR</span>
                        <span class="text-danger">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>

                    <h5 class="mt-4 fw-bold">Bukti Pembayaran ({{ ucfirst($order->payment_method) }})</h5>

                    @php
                        use Illuminate\Support\Facades\Storage;
                    @endphp

                    @if ($order->payment_method != 'cash' && $order->payment_proof_path)
                        <div class="mt-2 text-center">
                            <a href="{{ Storage::url($order->payment_proof_path) }}" target="_blank">
                                <img src="{{ Storage::url($order->payment_proof_path) }}" alt="Bukti Pembayaran"
                                    class="img-fluid rounded mb-2" style="max-height: 300px;">
                            </a>
                            <p class="text-muted mt-2">
                                Klik gambar untuk melihat bukti pembayaran ukuran penuh.
                            </p>
                        </div>
                    @elseif ($order->payment_method == 'cash')
                        <p class="alert alert-info py-2 mt-2">
                            Pembayaran <b>Tunai (Bayar di Tempat)</b>. Tidak memerlukan bukti bayar.
                        </p>
                    @else
                        <p class="alert alert-danger py-2 mt-2">
                            Bukti pembayaran belum diunggah oleh pelanggan.
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>