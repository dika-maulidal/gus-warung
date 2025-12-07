<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Keranjang - GusWarung</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet" />

    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #fffbea;
        }

        .navbar {
            background-color: #ffc107 !important;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff !important;
            font-weight: bold;
            font-family: "Playfair Display", serif;
        }

        .cart-container {
            max-width: 1200px;
            margin: 50px auto;
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .cart-item-row {
            display: flex;
            align-items: center;
            gap: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .cart-item-row img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 10px;
        }

        .cart-item-row h5 {
            font-weight: 600;
        }

        .cart-item-row .price {
            color: #ffc107;
            font-weight: 600;
        }

        .cart-summary {
            background-color: #fff8e1;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 100px;
        }

        .btn-checkout {
            background-color: #ffc107;
            color: white;
            font-weight: 600;
            width: 100%;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-checkout:hover {
            background-color: #e0aa00;
        }

        footer {
            text-align: center;
            padding: 20px 0;
            color: #555;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .cart-summary {
                margin-top: 20px;
            }
        }

        .payment-select {
            font-size: 0.95rem;
            padding: 8px 12px;
            border-radius: 8px;
            border: 2px solid #ffc107;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.2s ease;
        }

        .payment-select:focus {
            border-color: #e9b300;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top shadow-lg" style="background-color: #ffc107">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">
                <img src="{{ asset('logo/logo_guswarung tb.png') }}" alt="Logo" width="40" height="40" />
                GusWarung
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black active" href="{{ url('/sell') }}">Penjualan</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link text-black" href="{{ url('/stock') }}">Inventaris</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ url('/report') }}">Laporan</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link text-black" href="{{ url('/about') }}">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-black" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="material-symbols-outlined align-middle">account_circle</span>
                        </a>
                        <ul class="dropdown-menu bg-warning">
                            <li>
                                <a class="dropdown-item text-white bg-warning"
                                    href="{{ url('/setting') }}">Pengaturan</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-white bg-warning" href="#">Profil</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger bg-warning" href="#">Keluar</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container -->
    <div class="cart-container">
        <h2 class="fw-bold mb-4 text-warning text-center">
            <span class="material-symbols-outlined align-middle">shopping_cart</span>
            Keranjang Pesanan
        </h2>

        <div class="row">
            <!-- KIRI: Formulir dan pembayaran -->
            <div class="col-md-6">
                <!-- Informasi Pemesan -->
                <h5 class="fw-bold mb-3 text-warning">
                    <span class="material-symbols-outlined align-middle me-1">info</span>
                    Informasi Pemesanan
                </h5>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama Pemesan</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama lengkap" id="namaPemesan" />
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nomor Telepon</label>
                    <input type="tel" class="form-control" placeholder="Contoh: 081234567890" id="nomorTelepon" />
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Alamat Pengiriman</label>
                    <textarea class="form-control" rows="3" id="alamatPengiriman"
                        placeholder="Masukkan alamat lengkap, RT/RW, kecamatan, dan patokan..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Catatan Tambahan</label>
                    <textarea class="form-control" rows="2" id="catatanTambahan"
                        placeholder="Contoh: tanpa sambal, nasi setengah, bungkus terpisah..."></textarea>
                </div>

                <hr class="my-4" />

                <!-- Metode Pembayaran -->
                <h5 class="fw-bold mb-3 text-warning">
                    <span class="material-symbols-outlined align-middle me-1">credit_card</span>
                    Metode Pembayaran
                </h5>

                <div class="d-flex align-items-center mb-4">
                    <select class="form-select payment-select" id="paymentMethod">
                        <option selected disabled>Pilih metode pembayaran...</option>
                        <option value="cash">Tunai</option>
                        <option value="qris">QRIS</option>
                        <option value="transfer">Transfer Bank</option>
                    </select>
                    <img id="paymentLogo" src="" alt="Payment Logo" class="ms-3" width="42" height="42"
                        style="display: none" />
                </div>

                <button class="btn btn-checkout" id="btnProsesCheckout">
                    <span class="material-symbols-outlined align-middle me-1">shopping_bag</span>
                    Lanjut ke Pembayaran
                </button>

                {{-- Modal QRIS Dummy --}}
                <div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content text-center">
                            <div class="modal-header bg-warning text-white">
                                <h5 class="modal-title" id="qrisModalLabel">Pembayaran QRIS</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <h5>Total Bayar: <span class="text-warning" id="qrisTotalDisplay">Rp 0</span></h5>
                                <p class="text-muted">Silakan scan QR Code di bawah ini:</p>
                                {{-- QRIS Dummy Placeholder --}}
                                <img src="https://placehold.co/200x200/ffc107/FFF?text=QRIS+Dummy" alt="QRIS Code"
                                    class="img-fluid my-3 border rounded-lg p-2">
                                <p class="text-danger">Pembayaran akan otomatis dikonfirmasi setelah Anda scan.</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- KANAN: Item dan Ringkasan -->
            <div class="col-md-6">
                <div class="cart-summary">
                    <h5 class="fw-bold mb-3 text-center text-warning">Pesanan Anda</h5>

                    <!-- Daftar Item Cart DITEMPATKAN DI SINI -->
                    <div id="cart-items-list">
                        {{-- Content will be dynamically generated by JavaScript --}}
                        <p class="text-center text-muted m-4" id="empty-cart-message">Keranjang kosong. Ayo belanja!</p>
                    </div>

                    <hr />

                    <!-- Ringkasan Total -->
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span id="subtotal-display">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Ongkir</span>
                        <span id="ongkir-display">Rp 5.000</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>PPN (10%)</span>
                        <span id="ppn-display">Rp 0</span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span class="text-warning" id="total-display">Rp 0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© 2025 GusWarung. Semua hak dilindungi.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script untuk logic cart dan rendering di halaman checkout --}}
    {{-- Script untuk logic cart dan rendering di halaman checkout --}}
    <script>
        // =======================================================
        // 🚀 KONSTANTA
        // =======================================================
        const CART_STORAGE_KEY = 'guswarung_cart';
        const PPN_RATE = 0.10;
        const ONGKIR = 5000;

        /**
         * Mengambil data keranjang dari Local Storage.
         * @returns {Array} Daftar item keranjang.
         */
        function loadCart() {
            const cartJson = localStorage.getItem(CART_STORAGE_KEY);
            try {
                return cartJson ? JSON.parse(cartJson) : [];
            } catch (e) {
                console.error("Error parsing cart data from Local Storage", e);
                return [];
            }
        }

        /**
         * Menyimpan data keranjang ke Local Storage.
         * @param {Array} cart - Daftar item keranjang yang baru.
         */
        function saveCart(cart) {
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
            renderCart(); // Render ulang setiap kali ada perubahan
        }

        /**
         * Menghitung total biaya.
         * Ini adalah versi yang sudah diperbaiki agar total harga menjadi 0 jika keranjang kosong.
         */
        function calculateTotals(cart) {
            let subtotal = 0;
            cart.forEach(item => {
                subtotal += item.price * item.quantity;
            });

            // PPN dan Ongkir hanya dihitung/dikenakan jika ada subtotal (> 0)
            const ppn = subtotal > 0 ? subtotal * PPN_RATE : 0;
            const finalOngkir = subtotal > 0 ? ONGKIR : 0;

            // Total = Subtotal + PPN + Ongkir
            const total = subtotal + ppn + finalOngkir;

            return { subtotal, ppn, finalOngkir, total };
        }

        /**
         * Mengubah angka menjadi format Rupiah.
         */
        function formatRupiah(number) {
            return "Rp " + number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        /**
         * Mengupdate kuantitas item di keranjang.
         */
        function updateItemQuantity(event) {
            const button = event.currentTarget;
            const index = parseInt(button.dataset.index);
            const action = button.dataset.action;
            let cart = loadCart();

            // Logika cek stok di sini dapat ditambahkan jika diperlukan (mengambil data stok dari item)

            if (cart[index]) {
                if (action === 'increment') {
                    // Cek stok sebelum increment
                    if (cart[index].quantity < cart[index].stok) {
                        cart[index].quantity += 1;
                    } else {
                        console.warn(`Stok maksimal untuk ${cart[index].name} tercapai.`);
                    }
                } else if (action === 'decrement') {
                    cart[index].quantity -= 1;
                }

                if (cart[index].quantity <= 0) {
                    cart.splice(index, 1); // Hapus jika kuantitas <= 0
                }

                saveCart(cart);
            }
        }

        /**
         * Menghapus item dari keranjang.
         */
        function removeItem(event) {
            const index = parseInt(event.currentTarget.dataset.index);
            let cart = loadCart();

            if (cart[index]) {
                cart.splice(index, 1); // Hapus item pada index tersebut
                saveCart(cart);
            }
        }

        /**
         * Mengupdate total biaya di ringkasan.
         */
        function updateSummary(cart) {
            // Menggunakan nilai finalOngkir yang dihitung (bukan konstanta ONGKIR)
            const { subtotal, ppn, finalOngkir, total } = calculateTotals(cart);

            document.getElementById('subtotal-display').textContent = formatRupiah(subtotal);
            document.getElementById('ppn-display').textContent = formatRupiah(ppn);
            document.getElementById('ongkir-display').textContent = formatRupiah(finalOngkir);
            document.getElementById('total-display').textContent = formatRupiah(total);

            // Update display modal QRIS
            document.getElementById('qrisTotalDisplay').textContent = formatRupiah(total);

            // Menonaktifkan tombol checkout jika keranjang kosong
            const btnCheckout = document.getElementById('btnProsesCheckout');
            if (btnCheckout) {
                btnCheckout.disabled = cart.length === 0;
            }
        }

        /**
         * Merender item keranjang dan summary ke DOM.
         */
        function renderCart() {
            const cart = loadCart();
            const listContainer = document.getElementById('cart-items-list');
            const emptyMessage = document.getElementById('empty-cart-message');

            listContainer.innerHTML = ''; // Kosongkan daftar item

            if (cart.length === 0) {
                // Tampilkan pesan keranjang kosong
                if (emptyMessage) {
                    emptyMessage.style.display = 'block';
                    listContainer.appendChild(emptyMessage);
                }
            } else {
                // Sembunyikan pesan kosong dan render item
                if (emptyMessage) emptyMessage.style.display = 'none';

                cart.forEach((item, index) => {
                    const itemTotal = item.price * item.quantity;
                    const itemRow = document.createElement('div');
                    itemRow.className = 'cart-item-row';
                    itemRow.innerHTML = `
                        <img src="${item.image}" alt="${item.name}" />
                        <div class="flex-grow-1">
                            <h5>${item.name}</h5>
                            <p class="mb-1 text-muted">${item.unit} @ ${formatRupiah(item.price)}</p>
                            <p class="price mb-0">${formatRupiah(itemTotal)}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-outline-danger me-1 btn-update-qty" data-index="${index}" data-action="decrement">-</button>
                            <input type="number" class="form-control form-control-sm text-center cart-qty-input" value="${item.quantity}" min="1" style="width: 60px" data-index="${index}" readonly />
                            <button class="btn btn-sm btn-outline-success ms-1 btn-update-qty" data-index="${index}" data-action="increment">+</button>
                            <button class="btn btn-sm btn-link text-danger ms-2 btn-remove-item" data-index="${index}">
                                <span class="material-symbols-outlined fs-5">delete</span>
                            </button>
                        </div>
                    `;
                    listContainer.appendChild(itemRow);
                });

                // Attach event listeners for quantity buttons
                document.querySelectorAll('.btn-update-qty').forEach(btn => {
                    btn.addEventListener('click', updateItemQuantity);
                });
                document.querySelectorAll('.btn-remove-item').forEach(btn => {
                    btn.addEventListener('click', removeItem);
                });
            }

            // PENTING: Panggil updateSummary di sini untuk memastikan total harga disinkronkan
            updateSummary(cart);
        }

        /**
         * Logic Pembayaran & Inisialisasi DOM
         */
        document.addEventListener("DOMContentLoaded", () => {
            // PENTING: Panggil renderCart() di sini untuk memuat data dari Local Storage saat halaman diakses.
            renderCart();

            const select = document.getElementById("paymentMethod");
            const logo = document.getElementById("paymentLogo");
            const btnProsesCheckout = document.getElementById("btnProsesCheckout");

            // Event listener untuk ganti logo pembayaran
            select.addEventListener("change", () => {
                const value = select.value;
                logo.style.display = "inline-block";

                if (value === "cash") {
                    logo.src = "https://cdn-icons-png.flaticon.com/512/2331/2331942.png";
                } else if (value === "qris") {
                    logo.src = "https://images.seeklogo.com/logo-png/39/1/quick-response-code-indonesia-standard-qris-logo-png_seeklogo-391791.png";
                } else if (value === "transfer") {
                    logo.src = "https://i0.wp.com/www.halkidikisuites.com/wp-content/uploads/2023/02/38978-bank-transfer-logo-icon-vector-icon-vector-eps.png?fit=256%2C256&ssl=1";
                } else {
                    logo.style.display = "none";
                }
            });

            // Event listener untuk tombol Lanjut ke Pembayaran
            btnProsesCheckout.addEventListener('click', () => {
                const selectedMethod = document.getElementById('paymentMethod').value;
                const totalAmount = calculateTotals(loadCart()).total;

                if (selectedMethod === 'Pilih metode pembayaran...' || totalAmount === 0) {
                    console.warn("Mohon pilih metode pembayaran dan pastikan keranjang tidak kosong.");
                    alert("Mohon pilih metode pembayaran dan pastikan keranjang tidak kosong."); // Menggunakan alert agar terlihat oleh pengguna
                    return;
                }

                if (selectedMethod === 'qris') {
                    const qrisModal = new bootstrap.Modal(document.getElementById('qrisModal'));
                    qrisModal.show();
                } else {
                    const nama = document.getElementById('namaPemesan').value || 'Pelanggan';
                    const message = `Pesanan a/n ${nama} sebesar ${formatRupiah(totalAmount)} berhasil diproses dengan metode ${selectedMethod.toUpperCase()}. Terima kasih!`;

                    // *Simulasi Order Selesai*
                    localStorage.removeItem(CART_STORAGE_KEY);
                    renderCart(); // Render ulang (keranjang jadi kosong)

                    alert(message);
                }
            });
        });
    </script>
</body>

</html>