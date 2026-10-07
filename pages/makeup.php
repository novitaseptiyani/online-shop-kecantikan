<?php
 
$queryBrand = "
    SELECT DISTINCT b.id, b.nama_brand, b.deskripsi
    FROM brand b
    JOIN produk p ON b.id = p.brand_id
    WHERE p.kategori_id = 2
";
$resultBrand = mysqli_query($conn, $queryBrand);

$brands = [];

while ($brand = mysqli_fetch_assoc($resultBrand)) {
    $brand_id = $brand['id'];
    
    $queryProduk = "SELECT * FROM produk WHERE brand_id = $brand_id AND kategori_id = 2";
    $resultProduk = mysqli_query($conn, $queryProduk);

    $produkList = [];
    while ($produk = mysqli_fetch_assoc($resultProduk)) {
        $produkList[] = $produk;
    }

    $brands[] = [
        'id' => $brand['id'],
        'nama_brand' => $brand['nama_brand'],
        'deskripsi' => $brand['deskripsi'],
        'produk' => $produkList
    ];
}
?>

<main>
    <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-between align-items-center mb-4 text-center text-md-start" style="gap: 1rem;">
        <h2 class="fw-bold m-0">Find Your Makeup</h2>
            <form class="search-bar-container" action="index.php" method="GET">
                <input type="hidden" name="page" value="search">
                <input type="hidden" name="kategori" value="makeup">
                <input type="text" name="q" id="searchInputSkincare" class="search-input" placeholder="Search" required> 
                <button type="submit" id="searchButtonSkincare" class="icon-btn" disabled> 
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        <?php foreach ($brands as $brand): ?>
            <div class="mb-5 pb-4" style="margin-top: 4rem">
                <div class="mb-4">
                    <h2 class="mb-1 fw-bold"><?= htmlspecialchars($brand['nama_brand']); ?></h2>
                    <p class="mb-0 deskripsi-brand"><?= nl2br(htmlspecialchars($brand['deskripsi'])); ?></p>
                </div>

                <div class="row row-cols-2 row-cols-md-5 g-4">
                    <?php foreach ($brand['produk'] as $produk): ?>
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
                                        $buyNowLink = 'index.php?page=checkout&produk_id=' . $produk_id_saat_ini;

                                        if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] <= 0) {
                                            $_SESSION['redirect_after_login'] = 'checkout';
                                            $_SESSION['checkout_produk_id'] = $produk_id_saat_ini;
                                            $buyNowLink = 'index.php?page=login';
                                        }
                                        ?>
                                        <a href="<?= htmlspecialchars($buyNowLink); ?>"
                                        class="btn btn-skin flex-grow-1 me-2">
                                            Buy Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>    
