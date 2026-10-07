<main>
    <div class="berita-page">
        <div class="container">
            <section class="best-seller-section">
                <h2 class="fw-bold text-center">Best Seller</h2>
                <div class="row g-4">
                    <?php
                    $queryBestSeller = "SELECT * FROM produk WHERE best_seller = 1 LIMIT 10";
                    $resultBestSeller = mysqli_query($conn, $queryBestSeller);

                    if(mysqli_num_rows($resultBestSeller) > 0){
                        while($produk = mysqli_fetch_assoc($resultBestSeller)){
                            ?>
                            <div class="col-6 col-sm-6 col-md-3">
                                <div class="card h-100 shadow-sm">
                                    <img src="assets/images/Produk/<?= htmlspecialchars($produk['gambar']); ?>" class="card-img-top" 
                                    alt="<?= htmlspecialchars($produk['nama_produk']); ?>" style="height: 300px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title text-center"><?= htmlspecialchars($produk['nama_produk']); ?></h6>
                                        <p class="card-text text-pink text-center fw-bold">Rp. <?= number_format($produk['harga'], 0, ',', '.'); ?></p>
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
                                            <a href="<?= htmlspecialchars($buyNowLink); ?>" 
                                            class="btn btn-skin flex-grow-1 me-2">
                                                Buy Now
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>Produk best seller belum tersedia.</p>";
                    }
                    ?>
                </div>
            </section>
            
            <section class="beauty-news-section">
                <h2 class="fw-bold text-center">Beauty News</h2>
                <div class="row g-4">
                <?php
                $queryBerita = "SELECT id, judul, gambar FROM berita ORDER BY tanggal DESC LIMIT 6";
                $resultBerita = mysqli_query($conn, $queryBerita);

                if(mysqli_num_rows($resultBerita) > 0){
                    while($berita = mysqli_fetch_assoc($resultBerita)){
                        ?>
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="card h-100 shadow-sm">
                                <img src="assets/images/Berita/<?= htmlspecialchars($berita['gambar']); ?>" class="card-img-top" 
                                alt="<?= htmlspecialchars($berita['judul']); ?>" style="height: 400px; object-fit: cover;">
                                <div class="card-body d-flex flex-column p-4">
                                    <h5 class="card-title mb-4 text-center"><?= htmlspecialchars($berita['judul']); ?></h5>
                                    <a href="index.php?page=berita_detail&id=<?= $berita['id']; ?>" class="btn btn-skin px-4 py-2 mt-auto">Read More</a>
                                    </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='text-muted'>Belum ada berita terbaru.</p>";
                }
                ?>
                </div>
            </section>
        </div> 
    </div>
</main>