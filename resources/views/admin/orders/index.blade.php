<!DOCTYPE html>
<html lang="id">

<head>
    <title>Kelola Pesanan - Admin GusWarung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container my-5">
        <h1 class="mb-4 text-warning">Daftar Pesanan Baru</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary mb-3"><i
                class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard</a>
        <hr>

        {{-- Tampilkan Pesan Sukses jika ada (dari OrderManagementController) --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="bg-warning text-white">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Waktu</th>
                        <th>Nama Pelanggan</th>
                        <th>Total Bayar</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->created_at->format('d M H:i') }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($order->payment_method) }}</td>
                            <td>
                                @php
                                    $badgeClass = match ($order->status) {
                                        'Lunas' => 'bg-success',
                                        'Menunggu Pembayaran', 'Baru (Menunggu Konfirmasi)' => 'bg-info',
                                        'Menunggu Konfirmasi Admin' => 'bg-warning',
                                        'Diproses' => 'bg-primary',
                                        'Dibatalkan' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $order->status }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                    class="btn btn-sm btn-outline-warning">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada pesanan yang masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $orders->links() }}

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>