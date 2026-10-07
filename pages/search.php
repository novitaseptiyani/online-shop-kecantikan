<?php 

$search = isset($_GET['q']) ? trim($_GET['q']) : '';

$kategoriMap = [
    'skincare' => 1,
    'makeup' => 2
];

$kategoriNama = $_GET['kategori'] ?? '';
$kategori_id = $kategoriMap[$kategoriNama] ?? 0;

$produkList = [];

if ($search !== '' && $kategori_id) {
    $query = "
        SELECT p.*, b.nama_brand, b.deskripsi AS deskripsi_brand
        FROM produk p
        JOIN brand b ON p.brand_id = b.id
        WHERE p.kategori_id = ? 
        AND p.nama_produk LIKE ?
    ";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        $search_param = '%' . $search . '%'; 
        mysqli_stmt_bind_param($stmt, "is", $kategori_id, $search_param); // "i" untuk integer, "s" untuk string

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $produkList[] = $row;
            }
            mysqli_free_result($result);
        } else {
            error_log("Error fetching search results: " . mysqli_error($conn));
            echo "<p class='text-danger'>Terjadi kesalahan saat mengambil hasil pencarian.</p>";
        }

        mysqli_stmt_close($stmt);
    } else {
        error_log("Error preparing search query: " . mysqli_error($conn));
        echo "<p class='text-danger'>Terjadi kesalahan saat menyiapkan pencarian.</p>";
    }
} else {
    echo "<p class='text-muted'>Silakan masukkan kata kunci pencarian dan pastikan kategori valid.</p>";
}
?>

<main>
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-between align-items-center mb-4 text-center text-md-start" style="gap: 1rem;">
            <h2 class="fw-bold m-0">Search Result :</h2>
            <form class="search-bar-container" action="index.php" method="GET">
                <input type="hidden" name="page" value="search"> <input type="hidden" name="kategori" value="<?= htmlspecialchars($kategoriNama); ?>">
                <input type="text" name="q" class="search-input" placeholder="Search" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                <button type="submit" class="icon-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <?php if (!empty($produkList)): ?>
            <div class="mb-5 pb-4" style="margin-top: 4rem">
                <div class="mb-4">
                    <h2 class="mb-1 fw-bold">Hasil untuk : <?= htmlspecialchars($_GET['q'] ?? ''); ?></h2>
                </div>

                <div class="row row-cols-2 row-cols-md-5 g-4">
                    <?php foreach ($produkList as $produk): ?>
                        <div class="col-md-3">
                            <div class="card h-100 shadow-sm">
                                <img src="assets/images/Produk/<?= htmlspecialchars($produk['gambar']); ?>" class="card-img-top" 
                                    alt="<?= htmlspecialchars($produk['nama_produk']); ?>">
                                <div class="card-body d-flex flex-column text-center">
                                    <h5 class="card-title"><?= htmlspecialchars($produk['nama_produk']); ?></h5>
                                    <p class="card-text fw-bold">Rp. <?= number_format($produk['harga'], 0, ',', '.'); ?></p>
                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        <?php
                                        $produk_id_saat_ini = $produk['id']; 
                                        $buyNowLink = 'index.php?page=checkout&produk_id=' . $produk_id_saat_ini; // Default ke checkout

                                        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] <= 0) {
                                            $_SESSION['redirect_after_login'] = 'checkout';
                                            $_SESSION['checkout_produk_id'] = $produk_id_saat_ini;
                                            $buyNowLink = 'index.php?page=login';
                                        }
                                        ?>
                                        <a href="<?= htmlspecialchars($buyNowLink); ?>" class="btn btn-skin flex-grow-1 me-2">
                                            Buy Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <p class="text-muted">Tidak ada produk ditemukan untuk pencarian <strong><?= htmlspecialchars($_GET['q'] ?? '') ?></strong>.</p>
        <?php endif; ?>
    </div>
</main>