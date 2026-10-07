<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Terima kasih sudah membeli produk kami! Pesanan Anda sedang diproses.',
                confirmButtonColor: '#b98d94'
            });
        </script>";
    } elseif ($_GET['status'] == 'error') {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.',
                confirmButtonColor: '#a58faa'
            });
        </script>";
    }

    echo "
    <script>
        if (window.location.search.includes('status=')) {
            const url = new URL(window.location.href);
            url.searchParams.delete('status');
            window.history.replaceState({}, document.title, url.toString());
        }
    </script>";
}

if (!isset($_GET['produk_id'])) {
    echo "<p>Produk tidak ditemukan.</p>";
    exit;
}

$produk_id = intval($_GET['produk_id']);
$query = "SELECT * FROM produk WHERE id = $produk_id LIMIT 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<p>Produk tidak ditemukan.</p>";
    exit;
}

$produk = mysqli_fetch_assoc($result);
?>

<main>
    <div class="container py-5">
        <div class="mb-5">
            <h2 class="text-center fw-bold" style="margin-bottom: 3rem;">Checkout</h2>
        </div>
        
        <div class="row align-items-start">
            <div class="col-md-6 mb-4 mb-md-0 checkout-img-container pe-md-5">
                <img src="assets/images/Produk/<?= htmlspecialchars($produk['gambar']); ?>" 
                    alt="<?= htmlspecialchars($produk['nama_produk']); ?>" class="img-fluid img-fluid checkout-img">
            </div>

            <div class="col-md-6">
                <h5 class="text-center"><?= htmlspecialchars($produk['nama_produk']); ?></h5>
                <p class="text-center fw-bold">Rp<?= number_format($produk['harga'], 0, ',', '.'); ?></p>
                <form action="index.php?page=prosess_checkout" method="post">
                    <input type="hidden" name="produk_id" value="<?= $produk['id']; ?>">
                    <div class="mb-4">
                        <label for="nama_pembeli" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama_pembeli" name="nama_pembeli" class="form-control" required>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label">Alamat Pengiriman</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select id="metode_pembayaran" name="metode_pembayaran" class="form-select" required>
                            <option value="">Pilih Metode</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="cod">Cash on Delivery</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-skin">Beli Sekarang</button>
                </form>
            </div>
        </div>
    </div>    
</main>
