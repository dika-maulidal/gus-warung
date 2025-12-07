<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Keranjang - GusWarung</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
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

    <div class="cart-container">
        <h2 class="fw-bold mb-4 text-warning text-center">
            <span class="material-symbols-outlined align-middle">shopping_cart</span>
            Keranjang Pesanan
        </h2>

        <div class="row">
            <div class="col-md-6">
                {{-- Diubah menjadi Form yang mengarah ke OrderController@placeOrder --}}
                <form action="{{ route('user.place_order') }}" method="POST" enctype="multipart/form-data"
                    id="checkoutForm">
                    @csrf

                    <h5 class="fw-bold mb-3 text-warning">
                        <span class="material-symbols-outlined align-middle me-1">info</span>
                        Informasi Pemesanan
                    </h5>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Pemesan</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama lengkap" id="namaPemesan"
                            name="customer_name" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nomor Telepon</label>
                        <input type="tel" class="form-control" placeholder="Contoh: 081234567890" id="nomorTelepon"
                            name="customer_phone" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Pengiriman</label>
                        <textarea class="form-control" rows="3" id="alamatPengiriman" name="customer_address"
                            placeholder="Masukkan alamat lengkap, RT/RW, kecamatan, dan patokan..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Catatan Tambahan</label>
                        <textarea class="form-control" rows="2" id="catatanTambahan" name="notes"
                            placeholder="Contoh: tanpa sambal, nasi setengah, bungkus terpisah..."></textarea>
                    </div>

                    <hr class="my-4" />

                    <h5 class="fw-bold mb-3 text-warning">
                        <span class="material-symbols-outlined align-middle me-1">credit_card</span>
                        Metode Pembayaran
                    </h5>

                    <div class="d-flex align-items-center mb-4">
                        <select class="form-select payment-select" id="paymentMethod" name="payment_method" required>
                            <option value="" selected disabled>Pilih metode pembayaran...</option>
                            <option value="cash">Tunai (Bayar di Tempat)</option>
                            <option value="qris">QRIS</option>
                            <option value="transfer">Transfer Bank</option>
                        </select>
                        <img id="paymentLogo" src="" alt="Payment Logo" class="ms-3" width="42" height="42"
                            style="display: none" />
                    </div>

                    {{-- Area Baru untuk Instruksi & Upload Bukti Pembayaran --}}
                    <div id="paymentDetailsContainer" style="display: none;">
                        <hr class="my-4" />
                        <h5 class="fw-bold mb-3 text-warning">
                            <span class="material-symbols-outlined align-middle me-1">receipt</span>
                            Instruksi Pembayaran
                        </h5>

                        <div id="paymentInstruction" class="alert alert-info py-2 mb-3"></div>

                        <div class="mb-3" id="proofUploadSection">
                            <label for="proofOfPayment" class="form-label fw-bold">Upload Bukti Pembayaran</label>
                            <input class="form-control" type="file" id="proofOfPayment" name="proof_of_payment"
                                accept="image/*" />
                            <small class="form-text text-muted">Hanya untuk pembayaran QRIS/Transfer. Maks. 2MB.</small>
                        </div>
                    </div>
                    {{-- End Area Baru --}}

                    <button class="btn btn-checkout" type="submit" id="btnProsesCheckout" disabled>
                        <span class="material-symbols-outlined align-middle me-1">shopping_bag</span>
                        Proses Pesanan
                    </button>

                    {{-- Input tersembunyi untuk mengirim data yang dihitung JS ke Controller --}}
                    <input type="hidden" name="cart_data" id="cartDataInput">
                    <input type="hidden" name="total_amount" id="totalAmountInput">

                </form>

            </div>

            <div class="col-md-6">
                <div class="cart-summary">
                    <h5 class="fw-bold mb-3 text-center text-warning">Pesanan Anda</h5>

                    <div id="cart-items-list">
                        {{-- Content will be dynamically generated by JavaScript --}}
                        <p class="text-center text-muted m-4" id="empty-cart-message">Keranjang kosong. Ayo belanja!</p>
                    </div>

                    <hr />

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
    {{-- Diperbarui untuk mendukung form POST dan upload bukti bayar --}}
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
            const { subtotal, ppn, finalOngkir, total } = calculateTotals(cart);

            document.getElementById('subtotal-display').textContent = formatRupiah(subtotal);
            document.getElementById('ppn-display').textContent = formatRupiah(ppn);
            document.getElementById('ongkir-display').textContent = formatRupiah(finalOngkir);
            document.getElementById('total-display').textContent = formatRupiah(total);

            // Menonaktifkan tombol checkout jika keranjang kosong
            const btnCheckout = document.getElementById('btnProsesCheckout');
            if (btnCheckout) {
                // Tombol dinonaktifkan jika keranjang kosong ATAU jika metode pembayaran belum dipilih
                const selectedMethod = document.getElementById('paymentMethod') ? document.getElementById('paymentMethod').value : '';
                btnCheckout.disabled = cart.length === 0 || selectedMethod === '';
            }
        }

        /**
         * Merender item keranjang dan summary ke DOM.
         */
        function renderCart() {
            const cart = loadCart();
            const listContainer = document.getElementById('cart-items-list');

            // Simpan elemen empty-cart-message untuk digunakan kembali
            let emptyMessage = document.getElementById('empty-cart-message');
            if (!emptyMessage) {
                emptyMessage = document.createElement('p');
                emptyMessage.id = 'empty-cart-message';
                emptyMessage.className = 'text-center text-muted m-4';
                emptyMessage.textContent = 'Keranjang kosong. Ayo belanja!';
            }

            listContainer.innerHTML = ''; // Kosongkan daftar item

            if (cart.length === 0) {
                emptyMessage.style.display = 'block';
                listContainer.appendChild(emptyMessage);
            } else {
                emptyMessage.style.display = 'none';

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
                            <button type="button" class="btn btn-sm btn-outline-danger me-1 btn-update-qty" data-index="${index}" data-action="decrement">-</button>
                            <input type="number" class="form-control form-control-sm text-center cart-qty-input" value="${item.quantity}" min="1" style="width: 60px" data-index="${index}" readonly />
                            <button type="button" class="btn btn-sm btn-outline-success ms-1 btn-update-qty" data-index="${index}" data-action="increment">+</button>
                            <button type="button" class="btn btn-sm btn-link text-danger ms-2 btn-remove-item" data-index="${index}">
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

            updateSummary(cart);
        }

        /**
         * Logic Pembayaran & Inisialisasi DOM
         */
        document.addEventListener("DOMContentLoaded", () => {
            renderCart();

            const select = document.getElementById("paymentMethod");
            const logo = document.getElementById("paymentLogo");
            const paymentDetailsContainer = document.getElementById("paymentDetailsContainer");
            const paymentInstruction = document.getElementById("paymentInstruction");
            const proofUploadSection = document.getElementById("proofUploadSection");
            const btnProsesCheckout = document.getElementById("btnProsesCheckout");
            const checkoutForm = document.getElementById("checkoutForm");

            // Event listener untuk ganti logo pembayaran dan menampilkan instruksi/form upload
            select.addEventListener("change", () => {
                const value = select.value;
                const cart = loadCart();
                const { total } = calculateTotals(cart);

                logo.style.display = "inline-block";
                paymentDetailsContainer.style.display = "block"; // Tampilkan container detail
                proofUploadSection.style.display = "block"; // Default tampilkan upload
                document.getElementById('proofOfPayment').removeAttribute('required'); // Default tidak wajib

                if (value === "cash") {
                    logo.src = "https://cdn-icons-png.flaticon.com/512/2331/2331942.png"; // Icon Tunai
                    paymentInstruction.innerHTML = "Anda memilih Bayar di Tempat. Harap siapkan uang tunai sesuai total tagihan.";
                    proofUploadSection.style.display = "none"; // Sembunyikan upload untuk Tunai
                } else if (value === "qris") {
                    logo.src = "/img/qris.jpeg"; // Ganti dengan logo QRIS yang sesuai
                    paymentInstruction.innerHTML = `
                        <p class="text-center fw-bold mb-2">SCAN QRIS INI</p>
                        <img src="/img/qris.jpg" alt="QRIS Code" class="img-fluid my-2 d-block mx-auto border rounded-lg p-2">
                        <p class="text-center mb-0">Total: <span class="fw-bold text-warning">${formatRupiah(total)}</span></p>
                        <p class="mt-2 text-danger small">Setelah bayar, **WAJIB** upload bukti transfer di bawah.</p>
                    `;
                    document.getElementById('proofOfPayment').setAttribute('required', 'required'); // Wajibkan upload
                } else if (value === "transfer") {
                    logo.src = "https://i0.wp.com/www.halkidikisuites.com/wp-content/uploads/2023/02/38978-bank-transfer-logo-icon-vector-icon-vector-eps.png?fit=256%2C256&ssl=1";
                    paymentInstruction.innerHTML = `
                        Transfer ke **Bank XYZ - VA 1234567890** a/n GusWarung.
                        <br>Total: <span class="fw-bold text-warning">${formatRupiah(total)}</span>
                        <p class="mt-2 text-danger small">Setelah transfer, **WAJIB** upload bukti transfer di bawah.</p>
                    `;
                    document.getElementById('proofOfPayment').setAttribute('required', 'required'); // Wajibkan upload
                } else {
                    logo.style.display = "none";
                    paymentDetailsContainer.style.display = "none";
                }

                // Pastikan tombol checkout diaktifkan jika metode pembayaran dipilih
                updateSummary(cart); // Update status tombol checkout
            });

            // Mengganti Event Listener tombol Proses Checkout (Sekarang Submit Form)
            checkoutForm.addEventListener('submit', (event) => {
                const cart = loadCart();

                if (cart.length === 0) {
                    event.preventDefault(); // Cegah submit
                    alert("Keranjang kosong. Tidak dapat memproses pesanan.");
                    return;
                }

                const { total } = calculateTotals(cart);

                // 1. Validasi manual untuk input file jika QRIS/Transfer
                const selectedMethod = document.getElementById('paymentMethod').value;
                const proofFile = document.getElementById('proofOfPayment').files[0];

                if ((selectedMethod === 'qris' || selectedMethod === 'transfer') && !proofFile) {
                    // Cek jika tombol submit yang diklik, bukan yang lain (sudah ditangani oleh 'required' atribut)
                    // Jika Anda menggunakan logika JS yang kompleks, ini membantu validasi
                }

                // 2. Isi input tersembunyi dengan data yang dibutuhkan server
                // Data keranjang di-stringify menjadi JSON string
                document.getElementById('cartDataInput').value = JSON.stringify(cart);
                document.getElementById('totalAmountInput').value = total;

                // Jika semua validasi lolos, form akan disubmit secara alami ke route Laravel

                // Opsional: Hapus keranjang setelah submit, untuk pengalaman pengguna yang lebih baik
                // Namun, kita tidak menghapus di sini karena ingin menunggu konfirmasi dari server (Controller)
                // localStorage.removeItem(CART_STORAGE_KEY); 
            });

            // Panggil change event saat DOM load jika ada metode yang tersisa dari reload
            if (select.value && select.value !== '') {
                select.dispatchEvent(new Event('change'));
            }
        });
    </script>
</body>

</html>