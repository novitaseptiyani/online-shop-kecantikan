<main>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 text-center" style="margin-top: 20px;">
                <img src="assets/images/HeroVeeBeauté.png" alt="VeeBeauté Welcome" 
                    class="img-fluid rounded shadow" style="object-fit:">
            </div>

            <div class="col-md-6 text-center d-flex flex-column justify-content-between">
                <div class="mb-4" style="margin-top: 5rem;">
                    <h1 class="display-5 fw-bold mb-3">Temukan Cantikmu!</h1>
                    <p class="lead mb-4">
                        Hai, Cantik! Siap tampil glowing dan percaya diri? 
                        <br> Yuk jelajahi dunia kecantikan bersama VeeBeauté.
                    </p>
                    <a href="index.php?page=yourskin" class="btn btn-skin px-4 py-2">Find your skin type!</a>
                </div>
                
                <section class="best-seller-section text-start" style="margin-top: 5rem; margin-bottom: 4rem;">
                    <h2 class="fw-bold text-center">Best Seller</h2>
                    <div class="row g-3">
                        <?php
                        $queryBestSeller = "SELECT * FROM produk WHERE best_seller = 1 LIMIT 3";
                        $resultBestSeller = mysqli_query($conn, $queryBestSeller);

                        if(mysqli_num_rows($resultBestSeller) > 0){
                            while($produk = mysqli_fetch_assoc($resultBestSeller)){
                                ?>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="card h-100 shadow-sm">
                                        <img src="assets/images/Produk/<?= htmlspecialchars($produk['gambar']); ?>" class="card-img-top" 
                                            alt="<?= htmlspecialchars($produk['nama_produk']); ?>" style="height: 200px; object-fit: cover;">
                                        <div class="card-body d-flex flex-column text-center">
                                            <h6 class="card-title"><?= htmlspecialchars($produk['nama_produk']); ?></h6>
                                            <p class="card-text fw-bold">Rp. <?= number_format($produk['harga'], 0, ',', '.'); ?></p>
                                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                                <?php
                                                $buyNowLinkHome = 'index.php?page=login'; // Default: ke halaman login
                                                if (isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0) { // Cek apakah user sudah login
                                                    $buyNowLinkHome = 'index.php?page=checkout&produk_id=' . $produk['id']; // Jika sudah login, ke checkout
                                                }
                                                ?>
                                                <a href="<?= htmlspecialchars($buyNowLinkHome); ?>" 
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
                            echo "<p class='text-muted'>Produk best seller belum tersedia.</p>";
                        }
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>

