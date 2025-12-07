<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Dashboard - GusWarung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container my-5">
        <h1 class="mb-4 text-warning">Admin Panel GusWarung</h1>
        <hr>
        <div class="list-group">
            <a href="{{ route('admin.products.index') }}" class="list-group-item list-group-item-action fw-bold">
                <i class="fas fa-utensils me-2"></i> Manajemen Produk (Menu)
            </a>
            <a href="{{ route('admin.stock.index') }}" class="list-group-item list-group-item-action fw-bold">
                <i class="fas fa-boxes me-2"></i> Manajemen Stok
            </a>
            <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action fw-bold">
                <i class="fas fa-list-alt me-2"></i> Kelola Pesanan & Pembayaran ✨ **BARU**
            </a>
            <a href="#" class="list-group-item list-group-item-action text-muted">
                <i class="fas fa-chart-line me-2"></i> Cetak Laporan (Nanti)
            </a>
        </div>
        <div class="mt-4">
            <a href="/" class="btn btn-outline-secondary">Kembali ke Login</a>
        </div>
    </div>
</body>

</html>